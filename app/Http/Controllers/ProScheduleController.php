<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BusinessScheduleRequest;
use App\ProSchedule;
use App\User;
use App\ProPackage;
use Auth;

class ProScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
            $schedule_cont    = ProSchedule::where('user_id', Auth::user()->id)->first();
            $user_categories  = ProPackage::where('user_id', Auth::user()->id)->latest()->paginate(10);
            if($schedule_cont == null)
            {
                return view('professional.settings.schedule')->with(['user_categories' => $user_categories]);
            }else{
                $payments = explode(",", $schedule_cont->days);
                return view('professional.settings.save-schedule')->with([
                  'values' => $schedule_cont,
                  'payments' => $payments,
                  'user_categories' => $user_categories,
                ]);
            }

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
    public function create(BusinessScheduleRequest $request)
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $days = implode(',', $request->days);
          $payment_method = implode(',', $request->payment_method);
          ProSchedule::create([
            'user_id' => Auth::user()->id,
            'payment_method' => $payment_method,
            'deposit' => $request['deposit'],
            'refundable' => $request['refundable'],
            'days' => $days,
          ]);

          session()->flash('success', 'Information saved successfuly.');
          return redirect()->back();
        }
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function update(Request $request, ProSchedule $package)
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $days = implode(',', $request->days);
          $payment_method = implode(',', $request->payment_method);

          ProSchedule::where('user_id', Auth::User()->id)->update([
              'payment_method' => $payment_method,
              'deposit' => $request['deposit'],
              'refundable' => $request['refundable'],
              'days' => $days,
          ]);

          session()->flash('success', 'Info updated successfuly.');
          return redirect()->back();
            // $package->update([
            //   'payment_method' => $payment_method,
            //   'deposit' => $request['deposit'],
            //   'refundable' => $request['refundable'],
            //   'days' => $days,
            // ]);
          }
        }
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
