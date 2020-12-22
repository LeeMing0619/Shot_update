<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProPackage;
use App\User;
use App\Feedback;
use Auth;

class PublicProfileController extends Controller
{
    public function index(){

    }
    public function viewPackage($id)
    {
      $decode_id       = unserialize($id);
      $data            = ProPackage::where('id', $decode_id)->get();
      $user_categories = ProPackage::where('user_id', Auth::user()->id)->latest()->paginate(15);
      $feedbacks       = Feedback::where('pro_id', Auth::user()->id)->get();

      return view('public-profile.view-package')->with([
        'packages'        => $data,
        'user_categories' => $user_categories,
        'feedbacks'        => $feedbacks,
      ]);
    }
}
