<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
      return view('home.index', []);
    }


    public function adminLogin(Request $request) {
      if($request->has('username'))
      {
        $request->session()->put('user_session', [
          'id' => 1,
          'username' => $request->get('username')
        ]);

        return redirect('stk')->with('success', 'Information has been added');
      }
      return view('home.adminlogin');
    }

}
