<?php

namespace App\Http\Controllers;

use App\ProPackage;
use App\User;
use Auth;
use App\MainCategories;
use Illuminate\Http\Request;
use App\Http\Requests\BusinessPackageRequest;

class ProPackageController extends Controller
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
          $data = ProPackage::where('user_id', Auth::user()->id)->latest()->paginate(10);
          $main_categories = MainCategories::all();
          return view("professional.settings.package")->with([
            'packages' => $data,
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
    public function create(BusinessPackageRequest $request)
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          ProPackage::create([
            'user_id' => Auth::user()->id,
            'category' => $request['category'],
            'details' => $request['details'],
            'currency' => $request['currency'],
            'price' => $request['price'],
            'equipment' => $request['equipment'],
            'lenses' => $request['lenses'],
          ]);


          session()->flash('success', 'Package created successfuly.');

          return redirect(route('package.index'));

        }else{
          return redirect()->back();
        }
      }else{
        return redirect()->back();
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
     * @param  \App\ProPackage  $proPackage
     * @return \Illuminate\Http\Response
     */
    public function show(ProPackage $proPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProPackage  $proPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProPackage $package)
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $all_packages = ProPackage::where('user_id', Auth::user()->id)->where('id', '!=', $package->id)->latest()->get();
          return view("professional.settings.edit")->with([
            'package'=>$package,
            'all_package'=> $all_packages,
          ]);
        }
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProPackage  $proPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProPackage $package)
    {
      if (Auth::User()){
        if(Auth::user()->account_type == 'professional')
        {
          $package->update([
            'price' => $request->price,
            'currency' => $request->currency,
            'details' => $request->details,
            'equipment' => $request->equipment,
            'lenses' => $request->lenses,
          ]);

          // $package->save();

          session()->flash('success', 'Package edited successfuly.');
          return redirect(route('package.index'));
        }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProPackage  $proPackage
     * @return \Illuminate\Http\Response
     */
     public function destroy(ProPackage $package)
     {
       if (Auth::User()){
         if(Auth::user()->account_type == 'professional')
         {
           $package->delete();
           session()->flash('success', 'Package was deleted successfuly.');
           return redirect(route('package.index'));
         }
       }
     }
}
