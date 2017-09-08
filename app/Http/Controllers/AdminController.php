<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use App\User;
use App\Ad;
use App\Setting;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //to display the list of all ads
        $ads = Ad::all();
        return view('admins.index', ['ads' => $ads]);
    }

    public function newads()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //to display the list of all ads
        $ads = DB::table('ads')->where('approval', '=', 'PENDING')->get();
        return view('admins.newads', ['ads' => $ads]);
    }

    public function login()
    {
        return view('admins.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    public function addescision(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $ad = Ad::find($id);

        if($request->request_approval == "APPROVED")
        {
           $ad->approval = $request->request_approval;
           $ad->save();
        }
        else
        {
           $ad->approval = $request->request_approval;
           $ad->save();
        }

        $ads = DB::table('ads')->where('approval', '=', 'PENDING')->get();
        return view('admins.newads', ['ads' => $ads]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //to show details of an ad to the admin
        $ad = Ad::find($id);
        return view('admins.show', ['ad' => $ad]);
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

    public function flag()
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }
      $userid = Auth::User()->id;

      $ads = DB::table('ads')->where('flag', '>=', 15)->get();
      return view('admins.flag', ['ads'=>$ads]);
    }

    public function settings()
    {
      $settings = Setting::all();
      return view('admins.settings', ['settings' => $settings]);
    }

    public function settingsstore(Request $request)
    {
      $set = Setting::find(1);
      $set->min_cost = $request->min_cost;
      $set->cost_imp = $request->cost_imp;
      $set->save();

      $settings = Setting::all();
      return view('admins.settings', ['settings' => $settings]);
    }
}
