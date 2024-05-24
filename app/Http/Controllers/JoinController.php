<?php

namespace App\Http\Controllers;
use App\Models\Collaboration;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class JoinController extends Controller
{
    function display_collaboration_user()
    {
        
        $try = DB::table('staffs')->get();
        $datas = DB::table('staffs')
                ->join('collaborations', 'staffs.s_name', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get();

            //return dd($data);
                            
        return view('user.userdashboard', compact('try', 'datas'));
    }

    function display_collaboration_admin()
    {
        
        $try = DB::table('staffs')->get();
        $datas = DB::table('staffs')
                ->join('collaborations', 'staffs.s_name', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get();

            //return dd($data);
                            
        return view('admin.List_MoA', compact('try', 'datas'));
    }
}
