<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TrainingPositions;
use App\Models\Donation;


use App\Models\UserTrainings;
use Illuminate\Http\Request;

class TrainingPositionsContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pharmacy.addtraining');
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
        $pos = new TrainingPositions();
        $pos->fill($request->all());
        $pos->save();

        flash($pos->title . ' has been successfully saved.')->success();
        return back();
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
    public function edit($id)
    {
        $pos = TrainingPositions::find($id);

        return view('pharmacy.editTraining', compact('pos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param TrainingPositions $pos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pos = TrainingPositions::find($id);
        $pos->fill($request->all());
        $pos->save();

        flash($pos->name . ' has been successfully updated.')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingPositions $pos)
    {
        //
    }

    public function addPosition($id) {
        $pharmId = $id;
        return view('pharmacy.addtraining',compact('pharmId'));
    }

    public function viewTrainees($id) {
        $trainees = User::join('user_trainings as ut','users.id','ut.user_id')->where('ut.training_id', $id)->get();
        return view('pharmacy.viewappliedtrainee',compact('trainees'));
    }

    public function updateTraineesStatus($id, $status) {
        $pos = UserTrainings::find($id);
        $pos->status = $status;
        $pos->save();

        flash('Status has been successfully updated.')->success();
        return back();
    }

    public function viewTrainee($id) {
        $user = User::find($id);
        return view('pharmacy.traineeprofile',compact('user'));
    }

    public function downloadTraineeCv ($id) {
       $user = User::find($id);
       $filename= $user->cv_path;

        return response()->download(storage_path('app/cv/' . $filename));
    }

    public function applyTraining($userId, $tid) {
        $pos = UserTrainings::where('user_id',$userId)->where('training_id', $tid)->first();

        if (!$pos) {
            $training = new UserTrainings();
            $training->user_id = $userId;
            $training->training_id = $tid;
            $training->status = 0;
            $training->save();
        }

        flash('Applied Successfully.')->success();
        return back();
    }
}
