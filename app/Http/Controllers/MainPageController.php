<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewPhoto;
use App\User;
use Auth;

class MainPageController extends Controller
{
    public function index(){

      $gallery = NewPhoto::where('category', '!=', 'Professisonal')->latest()->paginate(15);
      foreach($gallery as $value)
      $user = User::all();
      // $user = User::where()->first();
      return view("welcome")->with([
        "gallery" => $gallery,
      ]);
    }
}
