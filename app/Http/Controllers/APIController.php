<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
use App\User;
use App\Ad;
use App\Price;
use App\Setting;

class APIController extends Controller
{
    public function getads()
    {
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

      return response()->json(['ads'=>$rand]);
    }

    public function reportads($id)
    {
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
      //dd($rand);
      return response()->json(['ads'=>$rand]);
    }
}
