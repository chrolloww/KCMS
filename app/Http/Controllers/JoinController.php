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

    public function update_collaboration($id)
    {
        // $data = Collaboration::with('Staff')->find($id);
        // if (!$data) 
        // {
        //     return redirect()->back()->with('error', 'Collaboration not found');
        // }
        
        $try = DB::table('staffs')->get();
        $data = DB::table('staffs')
                ->join('collaborations', 'staffs.s_name', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->where('collaborations.id', $id) 
                ->first();

        // $id = 'id';
        // $try = DB::table('staffs')->get();
        // $datas = DB::table('staffs')
        //         ->join('collaborations', 'staffs.s_name', '=', 'collaborations.c_focal_person')
        //         ->select('staffs.*', 'collaborations.*')
        //         -> where('id', $id)->get();
        
        return view('user.update_collaboration',compact('try', 'data'));
    }

    public function edit_collaboration(Request $request, $id)
    {
        $data = Collaboration::find($id);
        $data->c_type = $request->c_type;
        $data->save();
        return redirect('/userdashboard');
    }

    public function cancelUpdateCollaboration()
    {
        return redirect()->back();
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
