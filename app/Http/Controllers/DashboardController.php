<?php

namespace App\Http\Controllers;

use App\Models\TrainingPositions;
use App\Models\User;
use App\Models\UserTrainings;
use App\Models\State;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
      $relatedPharmcies = User::where('type', 2)->where('id','!=', $id)->where('city' , '=' , $pharmacyData->city)->get();
      $reviews = Review::where('pharm_id', $id)->get();
      $rating = Review::getAvg($id);
      return view('pharmacy.profile' ,compact(['trainingPos','pharmacyData', 'relatedPharmcies', 'reviews', 'rating']));
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
          'university' => $request->university,
          'letter' => $request->letter,
          'university_number' => $request->university_number
      ];

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
            'manager' => $request->manager,
            'students' => $request->students,
        ];

        if($request->has('image')) {
            $dest = 'assets/uploads/pharm';
            $image = request()->file('image');
            $fileName = Str::random(10) . '.' . $image->guessClientExtension();
            $image->move($dest,$fileName);
            $userArr['image'] = $fileName;
        }
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
        return view('welcome');
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
      $user->manager = $request->manager;
      $user->students = $request->students;
        if($request->has('image')) {
            $dest = 'assets/uploads/pharm';
            $image = request()->file('image');
            $fileName = Str::random(10) . '.' . $image->guessClientExtension();
            $image->move($dest,$fileName);
            $userArr['image'] = $fileName;
            $user->image = $fileName;

        }
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
        $user->university = $request->university;
        $user->university_number = $request->university_number;
        $user->letter = $request->letter;

        $user->save();

        flash('User has been successfully added.')->success();
        return back();

    }

    public function getPharmacaCount() {
        $pharmacy = ['Amman','Aqabah','Mafraq','At-Tafilah','Maan','Irbid','Ajlun','Jarash','Al-Balqa','Madaba','Al-Karak','Az-Zarqa'];
        $result = [];
        foreach ($pharmacy as $pharm) {

            $pharmacount = \DB::table('users')->where('city', $pharm)->count();
            $result[] = ['name'=>$pharm,'density'=> $pharmacount];
        }
        return \Response::json($result, 200);

    }

    public function getCountryPharma($city) {
      $pharmas = User::where('type',2)->where('city', $city)->get();
        $filter = '';
        return view('pharmacy.countryPharmacy',compact('pharmas','city','filter'));
    }

    public function updateFilterCity(Request $request) {
        $pharmas = User::where('type',2)->where('city', $request->city)->where('name', 'like', '%' . $request->name . '%')->get();
        $city = $request->city;
        $filter = $request->name;
        return view('pharmacy.countryPharmacy',compact('pharmas','city','filter'));
    }

}
