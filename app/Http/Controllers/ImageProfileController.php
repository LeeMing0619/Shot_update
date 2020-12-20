<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\ImageProfile;
use App\User;
use App\NewPhoto;
use Auth;

class ImageProfileController extends Controller
{
  public function index()
  {
      return view("imageprofile");
  }

  public function profileUpload(Request $request)
  {   
      if (Auth::User()){        
          //$user = User::find(Auth::user()->id);          
          $imageName = time().'.'.$request->profile_image->extension();  
      
          $request->profile_image->move(public_path('photos'), $imageName);

          $profile = NewPhoto::where([['user_id', Auth::User()->id], ['category', 'Professisonal']])->first();
        
          if($profile)
              return NewPhoto::where([['user_id', Auth::User()->id], ['category', 'Professisonal']])->update(['picture' => $imageName]);
          else
              return NewPhoto::create([
                  'user_id' => Auth::user()->id,
                  'picture' => $imageName,
                  'category' => 'Professisonal',
              ]);
      }else{
          return redirect('/');

      }
  }

  public function profileUploadFromBase64(Request $request)
  {   
      if (Auth::User()){        
          //$user = User::find(Auth::user()->id);                
          $image = $request->image;
          $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          
          $replace = substr($image, 0, strpos($image, ',')+1); 
          
          // find substring fro replace here eg: data:image/png;base64,
      
          $image64 = str_replace($replace, '', $image); 
          
          $image64 = str_replace(' ', '+', $image64); 
          
          $imageName = time().'.'.$extension;
          $image = base64_decode($image64);
          
          $path = public_path() . "/photos/" . $imageName;
      
          file_put_contents($path, $image);
          // $result = file_put_contents($path, $image); 
          
          $profile = NewPhoto::where([['user_id', Auth::User()->id], ['category', 'Professisonal']])->first();
        
          if($profile)
              return NewPhoto::where([['user_id', Auth::User()->id], ['category', 'Professisonal']])->update(['picture' => $imageName]);
          else
              return NewPhoto::create([
                  'user_id' => Auth::user()->id,
                  'picture' => $imageName,
                  'category' => 'Professisonal',
              ]);
      }else{
          return redirect('/');

      }
  }
}
