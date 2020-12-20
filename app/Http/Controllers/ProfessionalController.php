<?php

namespace App\Http\Controllers;

use App\Professional;
use App\User;
use App\ProPackage;
use Auth;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::User()){
          $user             = User::find(Auth::user()->id);
          $user_categories  = ProPackage::where('user_id', Auth::user()->id)->latest()->paginate(10);
          if($user){
            return view("professional.settings.settings")->with(['user' => $user,'user_categories' => $user_categories]);
          }else{
            return redirect()->back();
          }
        }else{
          return redirect()->back();
        }

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
     * @param  \App\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function show(Professional $professional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if($user) {
          $validate = null;
          if(Auth::user()->email === $request['email']){
            $validate = $request->validate([
              'first_name' => 'required',
              'last_name' => 'required',
              'email' => 'required|email',
              'phone_number' => 'required',
            ]);
          }else {
            $validate = $request->validate([
              'first_name' => 'required',
              'last_name' => 'required',
              'email' => 'required|email|unique:users',
              'phone_number' => 'required',
            ]);
          }
          if($validate){
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->pro_type = $request['pro_type'];
            $user->phone_number = $request['phone_number'];
            $user->receive_text = $request['receive_text'];
            $user->moto = $request['moto'];
            $user->business_adress = $request['business_adress'];

            $user->save();

            $request->session()->flash('success', 'Your details have now been updated!');
            return redirect()->back();
          }else{
            return redirect()->back();
          }
        }else{
          return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professional $professional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professional  $professional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professional $professional)
    {
        //
    }
}
