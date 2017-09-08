<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use App\User;
use App\Ad;
use App\Runningad;
use App\Price;
use App\Setting;


class AdController extends Controller
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
        $userid = Auth::User()->id;

        $ads = DB::table('ads')->where('user_id', $userid)->get();
        return view('ads.index', ['ads'=>$ads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::guest())
      {
        return view('auth.login');
      }

      $cost = Setting::find(1);
      $balance = Auth::User()->balance;
      if($balance < $cost->min_cost)
      {
        $response = "You account is too low to place and advert. Please top up your wallet";
        return view('home', ['res', $response]);
      }
      //$user = Auth::user();
        return view('ads.create', ['cost' => $cost]);
    }

    public function testing()
    {
      //$userloc = Auth::user()->location;
      $dat = date("Ymd");

      $set = Setting::find(1);
      $cpi = $set->cost_imp;
      //return $cpi;

      $rand = Ad::orderBy(DB::raw('RAND()'))
                  ->where('rem_amount', '>=', $cpi)
                  ->where('begin', '<=', $dat)
                  ->where('end', '>=', $dat)
                  ->where('approval', '!=', 'DECLINED')
                  ->take(5)->get();
      foreach ($rand as $r)
      {
        $adid = $r->id;
        $ad = Ad::find($adid);
        $ad->views += 1;
        $ad->rem_amount -= $cpi;
        $ad->save();
      }

      return view('ads.testing', ['ads' => $rand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //storing details of the ad
      /*$priority = $request->priority;
      $amount = $request->amount;

      if($priority == "High")
      {
        $adnum = $amount * 0.5;
      }
      if($priority == "Medium")
      {
        $adnum = $amount * 0.3;
      }
      if($priority == "Low")
      {
        $adnum = $amount * 0.1;
      }*/

        if (Auth::guest())
        {
           return view('auth.login');
        }

      $user_id = Auth::User()->id;
      if(empty($request->location))
      {
        $location = "General";
      }
      else
      {
        $location = implode(",", $request->location);
      }

      $user = Auth::User();

      $ad = new Ad;

      $imageName = $user->name . '_' . date('Ymds') . '.' .
      $request->file('image')->getClientOriginalExtension();

      $request->file('image')->move(
          base_path() . '/public/images/ads/', $imageName
      );

      $dura = strtotime("$request->end_date") - strtotime("$request->start_date");
      $dur = floor($dura / (60 * 60 * 24));
      //$dur = time();
      //return $dur;

      //getting values of begin and start date
      $begstr = $request->start_date;
      $endstr = $request->end_date;

      $begvals = explode('-',$begstr);
      $begin = $begvals[0].$begvals[1].$begvals[2];

      $endvals = explode('-',$endstr);
      $end = $endvals[0].$endvals[1].$endvals[2];

      $ad->user_id = $user_id;
      $ad->caption = $request->caption;
      $ad->approval = 'PENDING';
      $ad->brand_name = $user->name;
      $ad->duration = $dur;
      $ad->rem_duration = $dur;
      $ad->location = $location;
      $ad->image = $imageName;
      $ad->start_date = $request->start_date;
      $ad->end_date = $request->end_date;
      $ad->amount = $request->amount;
      $ad->rem_amount = $request->amount;
      $ad->begin = $begin;
      $ad->end = $end;
      $ad->save();

      $user->balance -= $request->amount;
      $user->save();

      $result = "Successful!!!";

      $cost = Price::find(1);
      return view('ads.create', ['result' => $result, 'cost' => $cost]);
    }

    public function search(Request $req)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        //checking user role
        $usid = Auth::user()->id;

        /*$check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
            return view('errors.404');
        }*/
        //dd($req->input('search'));
        $ads = null;
        if($req->has('search')&&($req->get('search')!=null))
        {
            /*$search = $req->get('search');
            $items=Item::where('asset_approval', '=', 'APPROVED')
                            ->where('disposal_status', '=', 'AVAILABLE')
                            ->where(function($query) use ($search) {
                                $query->where('id','like','%'.$search.'%')
                                ->orWhere('asset_number', 'like', '%'.$search.'%')
                                ->orWhere('item', 'like', '%'.$search.'%')
                                ->orWhere('department', 'like', '%'.$search.'%')
                                ->orWhere('classification', 'like', '%'.$search.'%');
                              })
                            ->OrderBy('id')->get();
                            //->paginate(10);*/
           
            $search = $req->get('search');
            $ads = Ad::where('user_id', '=', $usid)
                      ->where(function($query) use ($search) {
                                          $query->where('id','like','%'.$search.'%')
                                          ->orWhere('caption', 'like', '%'.$search.'%')
                                          ->orWhere('location', 'like', '%'.$search.'%');
                                        })
                            ->OrderBy('id')->get();

            //$ads = DB::table('ads')->where('user_id', $userid)->orWhere('user_id', $userid)->get();
            //dd($search);
        }
        else
        {
            $ads = Ad::paginate(20);
        }

        return view('ads.search',['ads' => $ads]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //to show a specific ad
        if (Auth::guest())
        {
           return view('auth.login');
        }
      $ads = Ad::find($id);
      return view('ads.show', ['ads' => $ads]);
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

    public function report($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        $ad = Ad::find($id);
        $ad->flag += 1;
        $ad->save();

        $dat = date("Ymd");

        $set = Setting::find(1);
        $cpi = $set->cost_imp;

        $rand = Ad::orderBy(DB::raw('RAND()'))
                    ->where('rem_amount', '>=', $cpi)
                    ->where('begin', '<=', $dat)
                    ->where('end', '>=', $dat)
                    ->where('approval', '!=', 'DECLINED')
                    ->take(5)->get();
        foreach ($rand as $r)
        {
          $adid = $r->id;
          $ad = Ad::find($adid);
          $ad->views += 1;
          $ad->rem_amount -= $cpi;
          $ad->save();
        }

        return view('ads.testing', ['ads' => $rand]);
    }

}
