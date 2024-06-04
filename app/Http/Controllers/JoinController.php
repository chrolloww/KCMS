<?php

namespace App\Http\Controllers;
use App\Models\Collaboration;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class JoinController extends Controller
{
    function display_collaboration_user()
    {
        $user = auth()->user()->staff_id;
        $try = DB::table('staffs')
                ->where('s_staff_id', $user)
                ->get();

        $datas = DB::table('staffs')
                ->where('s_staff_id', $user)
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get();

            // return dd($datas);

        return view('user.userdashboard', compact('try', 'datas'));
    }

    function display_collaboration_admin_MoA()
    {
        $try = DB::table('staffs')->get();
        $datas = DB::table('staffs')
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get()
                ->map(function ($item) {
                    $endDate = Carbon::parse($item->c_end_date);
                    $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                    return $item;
                });

            //return dd($datas);
                            
        return view('admin.list_collaboration.List_MoA', compact('try', 'datas'));
    }

    function display_collaboration_admin_MoU()
    {
        $try = DB::table('staffs')->get();
        $datas = DB::table('staffs')
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get()
                ->map(function ($item) {
                    $endDate = Carbon::parse($item->c_end_date);
                    $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                    return $item;
                });

            //return dd($datas);
                            
        return view('admin.list_collaboration.List_MoU', compact('try', 'datas'));
    }

    function display_collaboration_admin_LoI()
    {
        $try = DB::table('staffs')->get();
        $datas = DB::table('staffs')
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get()
                ->map(function ($item) {
                    $endDate = Carbon::parse($item->c_end_date);
                    $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                    return $item;
                });

            //return dd($datas);
                            
        return view('admin.list_collaboration.List_LoI', compact('try', 'datas'));
    }

    public function details_Active_LoI($c_name)
    {
        $try = DB::table('staffs')->get();

        $datas = DB::table('staffs')
            ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
            ->leftJoin('activities', 'collaborations.c_name', '=', 'activities.a_collaboration_name')
            ->select('staffs.*', 'collaborations.*', 'activities.*')
            ->orderBy('activities.created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $endDate = Carbon::parse($item->c_end_date);
                $item->duration_left = Carbon::now()->diffInDays($endDate, false);
                return $item;
            });


        $details = collect($datas)->where('c_name', $c_name)->values();

        if (!$details) {
            Log::error("Collaboration with name {$c_name} not found.");
            return abort(404, 'Collaboration not found');
        }

        //return dd($details);
        return view('admin.list_collaboration.details', compact('try', 'details'));
    }

    public function terminate(Request $request, $c_name)
    {
        $data = Collaboration::where('c_name', $c_name)->firstOrFail();

        // Update the status column to 'terminate'
        $data->c_status = 'TERMINATE';
        $data->save();

        return redirect()->back();
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
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->where('collaborations.id', $id) 
                ->first();

        // $id = 'id';
        // $try = DB::table('staffs')->get();
        // $datas = DB::table('staffs')
        //         ->join('collaborations', 'staffs.s_name', '=', 'collaborations.c_focal_person')
        //         ->select('staffs.*', 'collaborations.*')
        //         -> where('id', $id)->get();

        // return dd($data);

        return view('user.update_collaboration',compact('try', 'data'));
    }

    public function edit_collaboration(Request $request, $id)
    {
        $data = Collaboration::find($id);
        // $data->c_benefit = $request->c_benefit;
        // $data->c_type = $request->c_type;
        $image = $request->c_image;
        
        // The Image are all stored in public images. override the image for future enhancement
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->c_image->move('collabimages',$imagename);
            $data->c_image = $imagename;
        }

        $data->save();
        return redirect('/userdashboard');
    }

    public function cancelUpdateCollaboration()
    {
        return redirect()->back();
    }

    public function add_activities_page($id)
    {
        $try = DB::table('staffs')->get();
        $data = DB::table('staffs')
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->where('collaborations.id', $id) 
                ->first();

        return view('user.add_activities_page',compact('try', 'data'));
    }
}