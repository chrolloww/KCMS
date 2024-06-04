<?php

namespace App\Http\Controllers;
use App\Models\Collaboration;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
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
                            
        return view('admin.archive.archive_loi', compact('try', 'datas'));
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
                            
        return view('admin.archive.archive_moa', compact('try', 'datas'));
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
                            
        return view('admin.archive.archive_mou', compact('try', 'datas'));
    }

    function display_collaboration_admin_Terminate()
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
                            
        return view('admin.archive.archive_terminate', compact('try', 'datas'));
    }

    public function details_expired($c_name)
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


        $details = collect($datas)->where('c_status', 'terminate')->where('c_name', $c_name);

        if (!$details) {
            Log::error("Collaboration with name {$c_name} not found.");
            return abort(404, 'Collaboration not found');
        }

        return dd($details);
        //return view('admin.list_collaboration.details', compact('try', 'details'));
    }
}
