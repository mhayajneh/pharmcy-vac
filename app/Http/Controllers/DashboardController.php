<?php

namespace App\Http\Controllers;

use App\Models\TrainingPositions;
use App\Models\User;
use App\Models\UserTrainings;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $total_pharmacy = \DB::table('users')->where('type', 2)->count();
      $user_count = \DB::table('users')->where('type', 3)->count();
      $total_trainings = \DB::table('training_positions')->count();

      return view('dashboard' ,compact(['total_pharmacy','user_count', 'total_trainings']));
  }

  public function viewPharmacy($id) {
      $trainingPos = TrainingPositions::where('pharmacy_id',$id)->get();
      $pharmacyData = User::find($id);
      return view('pharmacy.profile' ,compact(['trainingPos','pharmacyData']));
  }

  public function viewTrainee($id) {
      $user = User::find($id);
      $userTrainings = UserTrainings::join('training_positions as tp','user_trainings.training_id','tp.id')
          ->join('users','tp.pharmacy_id', 'users.id')
          ->select('tp.title as tpTitle','users.*', 'user_trainings.status','user_trainings.created_at as dateApplied')
          ->where('user_trainings.user_id', $id)->get();

      return view('trainee.profile' ,compact(['user','userTrainings']));

  }

  public function editTraineeProfile($id) {
     $user = User::find($id);
      return view('trainee.editProfile' ,compact(['user']));
  }

  public function updateTraineeProfile(Request $request, $id) {
      $user = User::find($id);


      $userArr = [
          'name' => $request->name,
          'email' => $request->email,
          'number' => $request->number,
      ];

      if($request->has('usercv')) {
          $file_extention = $request->usercv->getClientOriginalExtension();
          $file_name = 'cv_'. $request->number . "_profile." .$file_extention;
          $request->usercv->storeAs('cv', $file_name);
          $userArr['cv_path'] = $file_name;
      }

      if ($request->password) {
        $userArr['password'] = Hash::make($request->password);
      }

      $user->update($userArr);

      flash('User has been successfully updated.')->success();
      return back();
  }

    public function editPharmacyProfile($id) {
        $user = User::find($id);
        return view('pharmacy.editProfile' ,compact(['user']));
    }

    public function updatePharmacyProfile(Request $request, $id) {
        $user = User::find($id);


        $userArr = [
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'city' => $request->city,
            'area' => $request->area,
            'location' => $request->location,
        ];

        if ($request->password) {
            $userArr['password'] = Hash::make($request->password);
        }

        $user->update($userArr);

        flash('User has been successfully updated.')->success();
        return back();
    }

    public function adminView() {
      $total_pharmacy = \DB::table('users')->where('type', 2)->count();
      $user_count = \DB::table('users')->where('type', 3)->count();
      $total_trainings = \DB::table('training_positions')->count();

      return view('dashboard' ,compact(['total_pharmacy','user_count', 'total_trainings']));
    }

    public function home() {
        return view('home');
    }

    public function getPharmacyCount() {
      $pharmacy = ['Amman','Aqabah','Mafraq','At-Tafilah','Maan','Irbid','Ajlun','Jarash','Al-Balqa','Madaba','Al-Karak','Az-Zarqa'];
     $count = 1;
     $result = [];
      foreach ($pharmacy as $pharm) {

          $pharmacount = \DB::table('users')->where('city', $pharm)->count();
          $result[] = ['department_id'=> $count,'department_name'=>$pharm,'amount_w'=> $pharmacount];
          $count++;
      }
      return \Response::json($result, 200);

  }

    public function search(Request $request){

        if($request->ajax()) {

            $data = User::where('name', 'LIKE', $request->country.'%')->where('type',2)
                ->get();

            $output = '';

            if (count($data)>0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row){

                    $output .= '<li class="list-group-item" data-id="'.$row->id.'">'.$row->name.'</li>';
                }

                $output .= '</ul>';
            }
            else {

                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }

            return $output;
        }
    }

    public function adminPharmacyList() {
      $pharms = User::where('type', 2)->get();
        return view('admin.pharmacy' ,compact('pharms'));
    }

    public function deletePharmacy($id) {
      $user = User::find($id);
      $user->delete();

        flash('Pharmacy has been successfully deleted.')->success();
        return back();

    }

    public function adminUserList() {
        $pharms = User::where('type', 2)->get();
        return view('admin.user' ,compact('pharms'));
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();

        flash('User has been successfully deleted.')->success();
        return back();

    }

    public function addNewPharmacy() {
        return view('admin.addpharmacy');
    }

    public function addNewUser() {
        return view('admin.adduser');
    }

    public function addAdminPharmacy(Request $request) {
      $user = new User();
      $user->name = $request->name;
      $user->type = 2;
      $user->email = $request->email;
      $user->number = $request->number;
      $user->area = $request->area;
      $user->city = $request->city;
      $user->password = Hash::make($request->password);
      $user->save();
        flash('Pharmacy has been successfully added.')->success();
        return back();
    }

    public function addAdminUser(Request $request) {
      $user = new User();

        $user->name = $request->name;
        $user->type = 3;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->password = Hash::make($request->password);

        if($request->has('usercv')) {
            $file_extention = $request->usercv->getClientOriginalExtension();
            $file_name = 'cv_'. $request->number . "_profile." .$file_extention;
            $request->usercv->storeAs('cv', $file_name);
            $user->cv_path = $file_name;
        }

        $user->save();

        flash('User has been successfully added.')->success();
        return back();

    }

}
