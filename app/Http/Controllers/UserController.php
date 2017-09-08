<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use App\User;
use App\Ad;
use App\Paymentlog;
use App\Setting;

class UserController extends Controller
{
    //handles all user actions and functions

    public function index()
    {

    }

    public function wallet()
    {
      $cost = Setting::find(1);
        if (Auth::guest())
        {
           return view('auth.login');
        }
    	//function to display wallet page
    	return view('users.wallet', ['cost' => $cost]);

    }

    public function fundwallet(Request $request)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
    	//function to handle payment
    	  $user = Auth::User();
    	  $gtpay_mert_id = 7675;
        $gtpay_tranx_id = "OL" . date("ymds");
        $amt = $request->amount + 105;
        $gtpay_tranx_amt = $amt * 100;
        $gtpay_tranx_curr = 566;
        $gtpay_cust_id = $user->id;
        $gtpay_tranx_noti_url = 'http://localhost:8000/responses';
        //http://olync.net/olync_app/get_eko_test_page
        $gtpay_cust_name = $user->name;
        $hashkey = 'E03D582001E94A268AB3D8E5630D102935DF2950920131BA31CD8D507814CDBE88BFA2F5BD8880F8786C692704477BB69B07F8FED0005DF56D94302B5FF93EF8';
        $gtpay_tranx_memo = "Advert payment for $gtpay_cust_name";
        $gtpay_echo_data = $hashkey;

        $tnx_code = $gtpay_mert_id . $gtpay_tranx_id . $gtpay_tranx_amt . $gtpay_tranx_curr . $gtpay_cust_id . $gtpay_tranx_noti_url . $hashkey;

        $gtpay_hash = hash('sha512', $tnx_code);

        $paylog = new Paymentlog;
        $paylog->user_id = $user->id;
        $paylog->tranx_id = $gtpay_tranx_id;
        $paylog->tranx_date_time = date('Y-m-d H:i:s');
        $paylog->tranx_amt = $request->amount;
        $paylog->save();

        return view('users.pay', ['gtpay_echo_data'=> $gtpay_echo_data, 'gtpay_tranx_memo' => $gtpay_tranx_memo, 'gtpay_tranx_noti_url' => $gtpay_tranx_noti_url, 'gtpay_cust_name' => $gtpay_cust_name, 'gtpay_mert_id' => $gtpay_mert_id, 'gtpay_tranx_id' => $gtpay_tranx_id, 'gtpay_tranx_amt' => $gtpay_tranx_amt, 'gtpay_tranx_curr' => $gtpay_tranx_curr, 'gtpay_cust_id' => $gtpay_cust_id, 'gtpay_hash' => $gtpay_hash]);
    	//dd($user_id);
    	//$user = User::find($user_id);
    	//return view('users.wallet');
    }

    public function responses(Request $request)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        //return "Here";
    	  //function to handle response from gtpay
    	  //getting all the values from the response url
    	  $gtpay_verification_hash = $request->gtpay_verification_hash;
        $gtpay_tranx_status_code = $request->gtpay_tranx_status_code;
        $gtpay_tranx_id = $request->gtpay_tranx_id;
        $gtpay_tranx_status_msg = $request->gtpay_tranx_status_msg;
        $gtpay_tranx_amt = $request->gtpay_tranx_amt;
        $gtpay_cust_id = $request->gtpay_cust_id;
        $gtpay_echo_data = $request->gtpay_echo_data;
        $gtpay_tranx_amt_small_denom = $request->gtpay_tranx_amt_small_denom;
        $gway_status_code = $request->gway_status_code;
        $hashar = "E03D582001E94A268AB3D8E5630D102935DF2950920131BA31CD8D507814CDBE88BFA2F5BD8880F8786C692704477BB69B07F8FED0005DF56D94302B5FF93EF8";
        $hash_code = $gtpay_tranx_id . $gtpay_tranx_amt_small_denom . $gtpay_tranx_status_code . $hashar;
        $myhash = hash('sha512', $hash_code);
        $myhash = strtoupper($myhash);

        if($myhash == $gtpay_verification_hash)
        {
        	$user = Auth::User();
            if($gtpay_tranx_status_code == "00")
            {
            	$user->balance += $gtpay_tranx_amt;
    			    $user->save();

              $gtlog = Paymentlog::where('tranx_id', $gtpay_tranx_id)->get();
              //dd($gtlog);

              Mail::send(['text'=>'emails.payment'],['name' => $user->name, 'amount' => $gtpay_tranx_amt, 'tranx_ref' => $gtpay_tranx_id],function($message) use($user){
                  $message->to($user->email, 'To '. $user->name)->subject('Transaction details');
                  $message->from('no-reply@olync.net', 'Olync Team');
              });

            }
            $customer = $user->name;
            return view('users.responses', ['customer' => $customer, 'gtpay_tranx_id' => $gtpay_tranx_id, 'gtpay_tranx_status_msg' => $gtpay_tranx_status_msg, 'gtpay_tranx_amt' => $gtpay_tranx_amt, 'gtpay_tranx_status_code' => $gtpay_tranx_status_code]);
        }
        else
        {
            return view('users.wallet');
        }
    }
}
