<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DonationReceived extends Notification
{
    use Queueable;

    /**
     * The donation that caused the notification.
     *
     * @var App\Models\Donation
     */
    protected $donation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Donation $donation)
    {
      $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      return [
        'name' => $this->donation->name,
        'state_id' => optional($this->donation->state)->id,
        'amount' => $this->donation->amount,
        'created_at' => $this->donation->created_at,
      ];
    }
}
