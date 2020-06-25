<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\Donation;
use App\Notifications\StateEnabled;
use App\Notifications\StateDisabled;

use Notification;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::withCount('donations')->get();
        $donation_count = Donation::count();
        $donation_amount = Donation::sum('amount');

        //return view('states.index', compact('states', 'donation_count', 'donation_amount'));


        $data = array(['department_id'=>1,'department_name'=>'Amman','amount_w'=> 5]);

        return \Response::json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {

        return view('states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
      if($request->has('is_visible')) {
        if($request->input('is_visible') == true) {
          Notification::send(User::all(), new StateEnabled($state, $request->user()));
        } elseif($request->input('is_visible') == false) {
          Notification::send(User::all(), new StateDisabled($state, $request->user()));
        }
      }

      $state->update($request->all());

      flash($state->name . ' has been successfully updated.')->success();
      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
    }
}
