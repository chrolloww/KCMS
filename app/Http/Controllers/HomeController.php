<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Collaboration;
use App\Models\Staff;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') 
        {
            return view('admin.home');
        } 
        
        else 
        {
            return view('user.home');
        }
    }

    public function index()
    {
        if(Auth::id())
        {
            return redirect('home');
        }

        else
        {
            return view('user.home');
        }
    }
}
