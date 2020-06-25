<?php

namespace App\Http\Controllers;

use Artisan;
use App\Models\Donation;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function run($task)
  {
    switch($task) {
      case 'clear-imports' :
        Donation::truncate()->get();

        flash('Imports have been deleted.')->success();
        return back();
      case 'import' :
        Artisan::call('mobilecause');

        flash('Import has been completed.')->success();
        return back();
    }
  }
}
