<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\DonationReceived;

use Notification;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Donation;
use Illuminate\Console\Command;

class MobileCause extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'mobilecause';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Check reports from MobileCause API';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    $request = app('mobilecause')->requestTransactions();

    $report_id = $request->getData()->id;

    $waiting = true;

    while($waiting) {
      $this->info('Requesting report id ' . $report_id);

      sleep(20);
      $report = app('mobilecause')->getReport($report_id);

      if( $report->isComplete() ) {
        break;
      }
    }

    $this->info('Report has ' . count($report->getData()) . ' rows');

    $this->syncDonations($report->getData());
  }


  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function syncDonations($donations)
  {
    $bar = $this->output->createProgressBar(count($donations));
    $bar->start();

    foreach($donations as $donation) {
      $state = State::whereAbbreviation($donation->state)->first();

      $donation = Donation::firstOrCreate(
        ['id' => $donation->donation],
        [
          'name' => $donation->first_name . ' ' . $donation->last_name,
          'email' => $donation->email,
          'city' => $donation->city,
          'zip' => $donation->zip,
          'amount' => str_replace('$','', $donation->collected_amount),
          'source' => $donation->source,
          'state_id' => optional($state)->id,
          'updated_at' => Carbon::parse($donation->transaction_date, 'UTC'),
          'created_at' => Carbon::parse($donation->donation_date, 'UTC')
        ]);

        if( $donation->wasRecentlyCreated ) {
          Notification::send(User::all(), new DonationReceived($donation));
        }
      $bar->advance();
    }
    $bar->finish();
  }
}
