<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Mail;
use App\User;
use App\NewPhoto;
use App\NewBooking;
use App\ProPackage;
use App\MainCategories;
use App\AcceptedJob;
use App\NewHire;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {        
        if (Auth::User()) {
          $profile      = NewPhoto::where([['user_id', Auth::User()->id], ['category', 'Professisonal']])->first();
          $profileImage ='';
          if($profile)
            $profileImage = $profile->picture;

          $pro_gallery      = NewPhoto::where([['user_id', Auth::User()->id], ['category', '!=', 'Professisonal']])->latest()->get();
          $main_categories  = MainCategories::all();
          $data             = ProPackage::where('user_id', Auth::user()->id)->latest()->paginate(15);
          
          if (Auth::user()->account_type != 'professional') {
            $cat_id = $request->input('catid');
            $jobID  = $request->input('jobId');
           
            $myJobs = NULL;
            if ($cat_id) {
              $category      = MainCategories::where('id', $cat_id)->pluck('category');              
              $myJobs        = NewBooking::where([['user_id', Auth::User()->id], ['done_hiring', 0], ['looking_to_shoot', $category]])->orderBy('created_at', 'desc')->paginate(10);
            }
            else
              $myJobs        = NewBooking::where([['user_id', Auth::User()->id], ['done_hiring', 0]])->orderBy('created_at', 'desc')->paginate(10);     
           
            $acceptedJOBS      = AcceptedJob::where([['client_id', Auth::User()->id], ['job_id', $jobID]])->get();
            $total_accepted    = AcceptedJob::where([['client_id', Auth::User()->id], ['hire_status', 0]])->get();
            $selectedJob       = NewBooking::where('id', $jobID)->get();            
            $openJobs          = AcceptedJob::where([['client_id', Auth::User()->id], ['hire_status', 1]])->paginate(10);
            $closedJobs        = AcceptedJob::where([['client_id', Auth::User()->id], ['hire_status', 2]])->paginate(10);
            $closedJobs_count  = AcceptedJob::where([['client_id', Auth::User()->id], ['hire_status', 2]])->get();

            return view('home')->with([
              'profile'             => $profileImage,
              'pro_gallery'         => $pro_gallery,
              'packages'            => $data,
              'main_categories'     => $main_categories,
              'myJobs'              => $myJobs,
              'acceptedJOBS'        => $acceptedJOBS,
              'selectedJOB'         => $selectedJob,
              'openJobs'            => $openJobs,
              'closedJobs'          => $closedJobs,
              'total_accepted'      => $total_accepted,
              'closedJobs_count'    => $closedJobs_count,
            ]);
          } else {
            return view('home')->with([
              'profile'         => $profileImage,
              'pro_gallery'     => $pro_gallery,
              'packages'        => $data,
              'main_categories' => $main_categories,
              'user_categories' => $data,
            ]);
          }    
        } else{
          return redirect('/');
        }   
    }

    public function proDash()
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        { 
          $orThose = [];
          $main_categories        = MainCategories::all();
          $check_packages         = ProPackage::where('user_id', Auth::user()->id)->get();   
          $matchThese             = ["locality" => Auth::user()->locality, "area" => Auth::user()->area];          
          $new_offers             = NewBooking::where($matchThese)->where(function ($q) use ($check_packages) {
                                                                      foreach ($check_packages as $package) {
                                                                        $q->orWhere('looking_to_shoot',  $package->category);
                                                                      }
                                                                    })->orderBy('created_at', 'desc')->paginate(10);
          $check_offers           = NewBooking::where($matchThese)->where(function ($q) use ($check_packages) {
                                                                      foreach ($check_packages as $package) {
                                                                        $q->orWhere('looking_to_shoot',  $package->category);
                                                                      }
                                                                    })->get();             
          $accept_offers          = AcceptedJob::where([['pro_id', Auth::user()->id],['hire_status', '0']])->paginate(10);
          $check_accept_offers    = AcceptedJob::where('pro_id', Auth::user()->id)->get();
          $hired_jobs             = AcceptedJob::where([['pro_id', Auth::user()->id],['hire_status', '1']])->paginate(10);
          $hired_jobs_count       = AcceptedJob::where([['pro_id', Auth::user()->id],['hire_status', '1']])->get();
          $completed_jobs         = NewHire::where([['pro_id', Auth::user()->id],['hire_status', '2']])->paginate(10);
          // ->orWhere($orThose)
          return view('professional.dashboard')->with([
            'new_offers'           => $new_offers,
            'accept_offers'        => $accept_offers,
            'hired_jobs'           => $hired_jobs,
            'hired_jobs_count'     => $hired_jobs_count,
            'main_categories'      => $main_categories,     
            'user_categories'      => $check_packages,       
            'check_offers'         => $check_offers,
            'check_accept_offers'  => $check_accept_offers,
            'completed_jobs'       => $completed_jobs,
          ]);
        }else{
          return redirect('/');
        }
      }else{
        return redirect('/');
      }
    }

    public function proProfile($id) 
    {
      if (Auth::User()) {
        $profile      = NewPhoto::where([['user_id', $id], ['category', 'Professisonal']])->first();
        $profileImage ='';
        if($profile)
          $profileImage = $profile->picture;

        $pro_gallery      = NewPhoto::where([['user_id', $id], ['category', '!=', 'Professisonal']])->latest()->get();
        $main_categories  = MainCategories::all();
        $data             = ProPackage::where('user_id', $id)->latest()->paginate(15);
        
        return view('client.find-pro')->with([
          'profile'         => $profileImage,
          'pro_gallery'     => $pro_gallery,
          'packages'        => $data,
          'user_id'         => $id,
          'user_categories' => $data,
        ]);
      } else {
        return redirect('/');
      }
    }

    public function invitePro(Request $request) 
    {
      if (Auth::User()) {
        $post_data = [
          'user_id' => Auth::user()->id,
          'pro_type' => 'Photographer',
          'looking_to_shoot' => 'Portrait',
          'event_address' => $request->event_address,
          'street_number' => $request->street_number,
          'route' => $request->route,
          'locality' => $request->locality,
          'area' => $request->area,
          'postal_code' => $request->postal_code,
          'country' => $request->country,
          'address_details' => $request->address_details,
          'duration_' => $request->duration_,
          'hours_' => $request->hours_,
          'event_date' => $request->event_date,
          'start_time' => $request->start_time,
          'time_zone' =>$request->time_zone,
          'done_hiring' => 1,
        ];

        $new_booking = NewBooking::create($post_data);

        $pro_email = User::where('id', $request->user_id)->first()->email;

        NewHire::create([
          'client_id'    => Auth::user()->id,
          'client_email' => Auth::user()->email,
          'job_id'       => $new_booking->id,
          'pro_id'       => $request->user_id,
          'pro_email'    => $pro_email,
          'hire_status'  => 1,
        ]);

        AcceptedJob::create([
          'client_id'     => Auth::user()->id,
          'client_email'  => Auth::user()->email,
          'pro_id'        => $request->user_id,
          'job_id'        => $new_booking->id,
          'job_price'     => $request->user_price * $request->duration_,
          'job_hours'     => $request->duration_,
          'pro_email'     => $pro_email,
          'hire_status'   => 1,
        ]);

        $details = [
          'subject'  => 'Hello',
          'email'    => $pro_email,
          'content'  => 'You just hired and invited a job. Thanks for using SeempleShots.com'
        ];
        Mail::send('mail', $details, function($message) use ($details) {
            $message->to($details['email'], '')->subject('Invitation from Client');
            $message->from('vendorforest1@gmail.com', 'SeempleShot');
        });

        return back();
      } else {
        return redirect('/');
      }
    }

    public function checkOffers(Request $request) 
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $matchThese       = ["locality" => Auth::user()->locality, "area" => Auth::user()->area];  
          $check_packages   = ProPackage::where('user_id', Auth::user()->id)->get();    
          $check_offers     = NewBooking::where($matchThese)->where(function ($q) use ($check_packages) {
                                                  foreach ($check_packages as $package) {
                                                    $q->orWhere('looking_to_shoot',  $package->category);
                                                  }
                                                })->get()->count();        
          $hired_jobs       = AcceptedJob::where([['pro_id', Auth::user()->id],['hire_status', '1']])->get()->count();

          if ($check_offers > $request->job_count)
            return ['status'    => true,
                    'message'   => 1,
                    'new_count' => $check_offers - $request->job_count,                    
                   ];            
          else if ($hired_jobs > $request->hired_count)
            return ['status'    => true,
                    'message'   => 2,
                    'new_count' => $hired_jobs - $request->hired_count,                    
                   ];
          else
            return ['status'  => false,];
        }
      } else{
        return redirect('/');
      }
    }

    public function checkBooking(Request $request) {
      if (Auth::User()){
        if(Auth::user()->account_type != 'professional')
        {          
          $send_offer  = AcceptedJob::where([['client_id', Auth::user()->id], ['hire_status', '0']])->get()->count();
          $closed_jobs = AcceptedJob::where([['client_id', Auth::user()->id], ['hire_status', '2']])->get()->count();
          
          if ($send_offer > $request->receive_count)
            return ['status'    => true,
                    'message'   => 1,
                    'new_count' => $send_offer - $request->receive_count,                    
                   ];            
          else if ($closed_jobs > $request->closed_cnt)
            return ['status'    => true,
                    'message'   => 2,
                    'new_count' => $closed_jobs - $request->closed_cnt,                    
                   ];
          else
            return ['status'  => false,];
        }
      } else{
        return redirect('/');
      }
    }

    public function portfolioDelete(Request $request) {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $id = $request->id;
          return NewPhoto::where('id', $id)->delete();          
        }
      } else{
        return redirect('/');
      }
    }
    
    public function editBooking(Request $request) {
      if (Auth::User()){
        if(Auth::user()->account_type != 'professional')
        {
          $job_id = $request->job_id;
          return NewBooking::where('id', $job_id)->get()->first();
        }
      } else{
        return redirect('/');
      }
    }

    public function changeBooking(Request $request) 
    {
      if (Auth::User()) {
        NewBooking::where('id', $request->booking_index)->update([
          "looking_to_shoot" => $request->looking_to_shoot,
          "address_details"  => $request->address_details,
          "duration_"        => $request->duration_,
          "hours_"           => $request->hours_,
        ]);
        return back();
      } else {
        return redirect('/');
      }
    }

    public function deleteBooking(Request $request) {
      if (Auth::User()){
        if(Auth::user()->account_type != 'professional')
        {
          $job_id = $request->job_id;
          AcceptedJob::where('job_id', $job_id)->delete();
          return NewBooking::where('id', $job_id)->delete();     
        }
      } else{
        return redirect('/');
      }
    }
    //Send job complete
    public function send_complete(Request $request) {
        if (Auth::User()) {
          if(Auth::user()->account_type == 'professional') {
            $job_id  = $request->job_id;
            $isExist = NewHire::where([['pro_id', Auth::user()->id], ['job_id', $job_id]])->first();
            if($isExist) {

              $details = [
                'subject'  => 'Hello',
                'email'    => $isExist->client_email,
                'content'  => 'Professional just complete the job. Thanks for using SeempleShots.com'
              ];
              Mail::send('mail', $details, function($message) use ($details) {
                  $message->to($details['email'], '')->subject('Complete Job');
                  $message->from('vendorforest1@gmail.com', 'SeempleShot');
              });

              NewBooking::where('id', $job_id)->update(['done_hiring'  => 2]);
              AcceptedJob::where([['pro_id', Auth::user()->id], ['job_id', $job_id]])->update(['hire_status'  => 2]);
              return NewHire::where([['pro_id', Auth::user()->id], ['job_id', $job_id]])->update(['hire_status'  => 2]);
            }
          }
        } else{
          return redirect('/');
        }
    }
    //Send offer when pro click accept offer button.....
    public function sendoffer(Request $request) {

      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $client_id    = $request->client_id;
          $client_email = $request->client_email;
          $job_id       = $request->job_id;
          $pro_id       = Auth::user()->id;
          $pro_email    = Auth::user()->email;
          $job_price    = $request->job_price;
          $job_hours    = $request->job_hours;
          
          $details = [
            'subject'  => 'Hello',
            'email'    => $client_email,
            'content'  => 'You just received proposal from SeempleShots.com. Thanks for using SeempleShots.com'
          ];
          Mail::send('mail', $details, function($message) use ($details) {
              $message->to($details['email'], '')->subject('Offer from Professional');
              $message->from('vendorforest1@gmail.com', 'SeempleShot');
          });

          return AcceptedJob::create([
            'client_id'     => $client_id,
            'client_email'  => $client_email,
            'pro_id'        => $pro_id,
            'job_id'        => $job_id,
            'job_price'     => $job_price,
            'job_hours'     => $job_hours,
            'pro_email'     => $pro_email,
            'hire_status'   => 0,
          ]);
        }
      } else{
        return redirect('/');
      }
    }

    //Delete Accepted JOB
    public function sendofferdel(Request $request) 
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $accepted_id = $request->accepted_id;
          $email       = AcceptedJob::where('id', $accepted_id)->get()->first()->client_email;
          $details = [
            'subject'  => 'Hello',
            'email'    => $email,
            'content'  => 'Professional cancel offers from SeempleShots.com. Thanks for using SeempleShots.com'
          ];
          Mail::send('mail', $details, function($message) use ($details) {
              $message->to($details['email'], '')->subject('Cancel Offer');
              $message->from('vendorforest1@gmail.com', 'SeempleShot');
          });

          return AcceptedJob::where('id', $accepted_id)->delete();          
        }
      } else{
        return redirect('/');
      }
    }

    public function requestfeedback(Request $request) {
      $details = [
        'subject'  => 'Hello, '.$request->name,
        'email'    => $request->email,
        'content'  => 'Professional request the feedback from SeempleShots.com. Thanks for using SeempleShots.com'
      ];
      Mail::send('mail', $details, function($message) use ($details) {
          $message->to($details['email'], '')->subject('Request Feedback');
          $message->from('vendorforest1@gmail.com', 'SeempleShot');
      });
    }

    public function bookings(Request $request) 
    {
        if (Auth::User()) {
          if (Auth::user()->account_type != 'professional') {
            $pro_id       = $request->pro_id;
            $pro_email    = $request->pro_email;
            $job_id       = $request->job_id;
            $client_id    = $request->client_id;
            $client_email = $request->client_email;
            $hire_status  = $request->hire_status;

            $isExist = NewHire::where([['pro_id', $pro_id], ['job_id', $job_id]])->first();
            if($isExist) {              
              NewHire::where([['pro_id', $pro_id], ['job_id', $job_id]])->update(['hire_status'  => $hire_status]);
            } else {
              NewHire::create([
                'client_id'    => $client_id,
                'client_email' => $client_email,
                'job_id'       => $job_id,
                'pro_id'       => $pro_id,
                'pro_email'    => $pro_email,
                'hire_status'  => $hire_status,
              ]);
            }

            if ($hire_status == 1) {
              $details = [
                'subject'  => 'Hello',
                'email'    => $pro_email,
                'content'  => 'Client just hired you from SeempleShots.com. Thanks for using SeempleShots.com'
              ];
              Mail::send('mail', $details, function($message) use ($details) {
                $message->to($details['email'], '')->subject('Hired');
                $message->from('vendorforest1@gmail.com', 'SeempleShot');
              });
            }

            NewBooking::where('id', $job_id)->update(['done_hiring'  => $hire_status]);
            return AcceptedJob::where([['pro_id', $pro_id], ['job_id', $job_id]])->update(['hire_status'  => $hire_status]);            
          }
        }
    }

    public function client_register()
    {
      return view('auth.client-register');
    }
    public function pro_register()
    {
      return view('auth.register');
    }
}
