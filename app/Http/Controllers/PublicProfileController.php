<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProPackage;
use App\User;
use Auth;

class PublicProfileController extends Controller
{
    public function index(){

    }
    public function viewPackage($id)
    {
      $decode_id = unserialize($id);
      $data = ProPackage::where('id', $decode_id)->get();
      return view('public-profile.view-package')->with([
        'packages' => $data,
      ]);
    }
}
