<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Collaboration;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function redirect(Request $request)
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') 
        {
            $filter = $request->query('filter', 'LoI');
            $expire = $request->query('expire', 'MoA');
            $currentYear = date("Y");
            

            $total = DB::table('users')
            ->join('collaborations', 'users.staff_id', '=','collaborations.c_focal_person')
            ->select('collaborations.c_name', 'collaborations.c_start_date', 'collaborations.c_end_date', 'collaborations.c_status', DB::raw('count(collaborations.c_name) as total_collaboration'))
            ->where('users.usertype', '!=', 1)
            ->groupBy('collaborations.c_name', 'collaborations.c_start_date', 'collaborations.c_end_date','collaborations.c_status')
            ->get()
            ->map(function ($item) {
                $endDate = Carbon::parse($item->c_end_date);
                $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                return $item;
            });

            $datas = DB::table('users')
            ->join('collaborations', 'users.staff_id', '=','collaborations.c_focal_person')
            ->select('collaborations.c_name', 'collaborations.c_type', 'collaborations.c_start_date', 'collaborations.c_end_date', 'collaborations.c_status', DB::raw('count(collaborations.c_name) as total_collaboration'))
            ->where('users.usertype', '!=', 1)
            ->when($filter, function ($query, $filter) {
                return $query->where('collaborations.c_type', $filter);
            })
            ->groupBy('collaborations.c_name', 'collaborations.c_type', 'collaborations.c_start_date', 'collaborations.c_end_date','collaborations.c_status')
            ->get()
            ->map(function ($item) {
                $endDate = Carbon::parse($item->c_end_date);
                $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                return $item;
            });

            $datase = DB::table('users')
            ->join('collaborations', 'users.staff_id', '=','collaborations.c_focal_person')
            ->select('collaborations.c_name', 'collaborations.c_type', 'collaborations.c_start_date', 'collaborations.c_end_date', 'collaborations.c_status', DB::raw('count(collaborations.c_name) as total_collaboration'))
            ->where('users.usertype', '!=', 1)
            ->when($expire, function ($query, $expire) {
                return $query->where('collaborations.c_type', $expire);
            })
            ->groupBy('collaborations.c_name', 'collaborations.c_type', 'collaborations.c_start_date', 'collaborations.c_end_date','collaborations.c_status')
            ->get()
            ->map(function ($item) {
                $endDate = Carbon::parse($item->c_end_date);
                $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                return $item;
            });

            $graphData = DB::table('users')
                ->join('collaborations', 'users.staff_id', '=','collaborations.c_focal_person')
                ->selectRaw('YEAR(c_start_date) as year, COUNT(c_name) as total')
                ->whereBetween('c_start_date', [now()->subYears(5), now()])
                ->groupBy('year')
                ->get();

            $data = "";
            foreach ($graphData as $values) {
                $data.= "[".$values->year.",  ".$values->total."],";
            }

            $staff = DB::table('staffs')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('collaborations')
                    ->whereRaw('staffs.s_staff_id = collaborations.c_focal_person');
            })
            ->count();



            //return dd($staff);
            return view('admin.home',compact('total', 'datas','filter', 'datase', 'expire','data','staff'));
            //return view('admin.home');
        } 
        
        else 
        {
            $user = auth()->user()->staff_id;
        $try = DB::table('staffs')
                ->where('s_staff_id', $user)
                ->get();

        $datas = DB::table('staffs')
                ->where('s_staff_id', $user)
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->select('staffs.*', 'collaborations.*')
                ->get()
                ->map(function ($item) {
                    $endDate = Carbon::parse($item->c_end_date);
                    $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                    return $item;
                });

        //return dd($datas);
        return view('user.userdashboard', compact('try', 'datas'));
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
