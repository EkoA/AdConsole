<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Ad;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $user_type = Auth::User()->acct_type;
        if($user_type == 'ADMIN')
        {
            //$ads = Ad::all();
            $ads = DB::table('ads')
                     ->select(DB::raw('count(*) as ad_count')) 
                     ->get();

            $pads = DB::table('ads')
                     ->select(DB::raw('count(*) as pad_count'))
                     ->where('approval', 'PENDING') 
                     ->get();                     

            return view('admins.home', ['ads' => $ads, 'pads' => $pads]);
        }
        else
        {
            $userid = Auth::User()->id;

            $ads = DB::table('ads')->where('user_id', $userid)->get();
            return view('ads.index', ['ads'=>$ads]); 
        } 
    }
}
