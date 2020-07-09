<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function store(request $request){
        $this->validate($request, [
           'title' => 'required',
           'rating' => 'required',
        ]);

        Review::create($request->all());
        return Redirect::back();
    }
}
