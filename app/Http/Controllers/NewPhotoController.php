<?php

namespace App\Http\Controllers;


use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\NewPhoto;
use Auth;

class NewPhotoController extends Controller
{
  public function index()
  {
      return view("professional.upload-photo.new-photo");
  }

  protected $redirectTo = RouteServiceProvider::HOME;

  public function StorePhoto(Request $request){

    $photo = new NewPhoto;

    if($request->hasFile('picture')) {
      foreach($request->file('picture') as $image) {
        $completeFileName = $image->getClientOriginalName();
        $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $compPic = str_replace(' ', '_', $fileNameOnly).'-'.rand() .'_'.time().'.'.$extension;
        $path = $image->move(public_path('storage/photos'), $compPic);
        $data[] = $compPic;
      }
        $photo->picture  = json_encode($data);
        $photo->category = $request->category;
        $photo->user_id  = Auth::User()->id;
        $photo->save();
      return ['status' => true, 'message' => 'Image has been added in your account successfuly'];
    } else{
        return ['status' => true, 'message' => 'Something went wrong with our server, try again later.'];
    }

    // if($photo->save()){
    //   return ['status' => true, 'message' => 'Image has been added in your account successfuly'];
    // }else{
    //   return ['status' => true, 'message' => 'Something went wrong with our server, try again later.'];
    // }


  }

  public function photodestroy(Request $request){

  }
}
