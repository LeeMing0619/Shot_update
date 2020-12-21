<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\User;
use Auth;
use App\NewBooking;
use App\MainCategories;
use Carbon\Carbon;
use App\Http\Requests\NewBookingRequest;
use App\Notifications\SendEmailNotification;

class NewBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::User())
      {
        if(Auth::User()->account_type == 'client')
        {
          $main_categories = MainCategories::all();
          return view('client.new-booking')->with([
            'main_categories' => $main_categories,
          ]);
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
    public function create(NewBookingRequest $request)
    {

      // $now = date('Y-m-d'); //Fomat Date and time
      // //$now = $request->event_date;

      // $data = request()->validate([
      //   'duration_'  => "required",
      //   'event_date' => "required|date_format:Y-m-d",
      // ]);

      $post = ([
        'user_id' => Auth::user()->id,
        "pro_type" => $request->pro_type,
        "looking_to_shoot" => $request->looking_to_shoot,
        "event_address" => $request->event_address,
        "street_number" => $request->street_number,
        "route" => $request->route,
        "locality" => $request->locality,
        "area" => $request->area,
        "postal_code" => $request->postal_code,
        "country" => $request->country,
        "address_details" => $request->address_details,
        "duration_" => $request->duration_,
        "hours_" => $request->hours_,
        "event_date" => $request->event_date,
        "start_time" => $request->start_time,
        "time_zone" => $request->time_zone
        //"allow_employee" => $request->allow_employee,
      ]);

      NewBooking::create($post);
      $users = User::where('account_type', '!=', 'client')->get();
      foreach ($users as $user) {
        if (ProPackage::where([['user_id', $user->id], ['category', $request->looking_to_shoot]])->get()->count() > 0) {
          $details = [
            'greeting'   => 'Hi'.$user->first_name,
            'body'       => 'Posted new Job from SeempleShots.com',
            'thanks'     => 'Thanks you for using SeempleShots.com',
            'actionText' => 'Please check it',
            'actionURL'  => url('/'),
            'order_id'   => 101,
          ];
          Notification::send($user, new SendEmailNotification($details));
        }
          
      }

      return back();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
