<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\User;
use App\NewHire;
use App\Feedback;

use Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($job_id)
    {
        return view('feedback')->with([
            'job_id' => $job_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FeedbackRequest $request)
    {
        //
        if (Auth::User()) {
            $job = NewHire::where('job_id', $request->job_id)->get()->first();

            $post = ([
                'client_id'   => Auth::User()->id,
                "pro_id"      => $job->pro_id,
                "job_id"      => $request->job_id,
                "rate"        => $request->rate,
                "skills"      => $request->skills,
                "quality"     => $request->quality,
                "description" => $request->description,
                "experience"  => $request->experience,
            ]);
        
            Feedback::create($post);
        
            return redirect('/home?tab=closed_contract');
        } else {
            return redirect('/');
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
