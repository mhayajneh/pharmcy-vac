<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $campaign = new \stdClass();
      $campaign->name = optional(Setting::find('campaign.name'))->value;
      $campaign->start_date = optional(Setting::find('campaign.start_date'))->value;
      $campaign->end_date = optional(Setting::find('campaign.end_date'))->value;
      $campaign->privacy = optional(Setting::find('campaign.privacy'))->value;
      $settings = Setting::where('key', 'NOT LIKE', 'campaign.%')->get();



      return view('settings.index', compact('settings', 'campaign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if( $request->input('multiple') == true ) {
        foreach($request->input('campaign') as $key => $value) {
          if(is_null($value)) { continue; }

          Setting::updateOrCreate(
            ['key' => 'campaign.' . $key],
            [
              'description' => 'Campaign Setting.',
              'value' => $value
            ]
          );
        }
        flash('The Campaign Settings have been successfully updated.')->success();

      } else {
        $setting = Setting::create([
          'key' => $request->input('key'),
          'description' => $request->input('description'),
          'value' => $request->input('value'),
          'user_id' => auth()->user()->id
        ]);
      }

      return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
      return view('settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
      return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->all());

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
