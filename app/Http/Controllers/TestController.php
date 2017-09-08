<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function showPg(Request $request)
    {
      return view('testpg');
    }

    public function receiveTest(Request $request)
    {
      return 'working';
    }
}
