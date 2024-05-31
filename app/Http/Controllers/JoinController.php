<?php

namespace App\Http\Controllers;
use App\Models\Collaboration;
use App\Models\Staff;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class JoinController extends Controller
{
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

    public function details($id)
    {
        $try = DB::table('staffs')->get();

        $details = DB::table('staffs')
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->leftJoin('activities', 'collaborations.c_name', '=', 'activities.a_collaboration_name')
                ->where('collaborations.id',$id)
                ->select('staffs.*', 'collaborations.*','activities.*')
                ->get()
                ->map(function ($item) {
                    $endDate = Carbon::parse($item->c_end_date);
                    $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                    return $item;
                });

        //return dd($details);
        return view('admin.list_collaboration.details', compact('try', 'details'));
    }

    public function terminate(Request $request, $c_name)
    {
        $request->validate([
            'termination_reason' => 'required|string|max:255',
        ]);

        $collaboration = Collaboration::where('c_name', $c_name)->first();

        // Check if collaboration exists
        if (!$collaboration) {
            return redirect()->back()->with('error', 'Collaboration not found.');
        }

        // Perform termination actions here, for example:
        $collaboration->c_status = 'TERMINATE';
        $collaboration->c_description = $request->termination_reason;
        $collaboration->save();

        return redirect('/List_LoI')->with('success', 'Collaboration terminated successfully.');
    }

    public function update_collaboration($id)
    {
        // $data = Collaboration::with('Staff')->find($id);
        // if (!$data) 
        // {
        //     return redirect()->back()->with('error', 'Collaboration not found');
        // }

        $user = auth()->user()->staff_id;
        $try = DB::table('staffs')
                ->where('s_staff_id', $user)
                ->get();

        $datas = DB::table('staffs')
                ->join('collaborations', 'staffs.s_staff_id', '=', 'collaborations.c_focal_person')
                ->where('s_staff_id', $user)
                ->where('collaborations.id',$id)
                ->select('staffs.*', 'collaborations.*')
                ->get()
                ->map(function ($item) {
                    $endDate = Carbon::parse($item->c_end_date);
                    $item->duration_left = Carbon::now()->diffInDays($endDate, false); // Calculate days left
                    return $item;
                });

        //return dd($datas);

        // $id = 'id';
        // $try = DB::table('staffs')->get();
        // $datas = DB::table('staffs')
        //         ->join('collaborations', 'staffs.s_name', '=', 'collaborations.c_focal_person')
        //         ->select('staffs.*', 'collaborations.*')
        //         -> where('id', $id)->get();

        //return dd($data);
        return view('user.userdashboard',compact('try', 'datas'));
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

    public function store(Request $request)
    {
        $data = Collaboration::where('c_name', $c_name)->firstOrFail();
        $data->c_description = $request->c_type;
        $data->c_status = 'TERMINATE';
        $data->save();

        return redirect()->back();
    }

    public function user_details_view($c_name)
    {
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

        $details = $datas->filter(function ($item) use ($c_name) {
            return $item->c_name === $c_name;
        })->values();

        if ($details->isEmpty()) {
            Log::error("Collaboration with name {$c_name} not found.");
            return abort(404, 'Collaboration not found');
        }

        //return dd($details);
        return view('user.details.collaboration_details', compact('details'));
    }

    public function updateCollaborationactivities(Request $request, $c_name)
{
    $request->validate([
        'a_activity_name' => 'required|string|max:255',
        'a_activity_description' => 'required|string|max:255',
        'activity_date' => 'required|date',
    ]);

    $collaboration = Collaboration::where('c_name', $c_name)->first();

    if (!$collaboration) {
        return redirect()->back()->with('error', 'Collaboration not found.');
    }

    $activity = new Activity();
    $activity->a_activity_name = $request->a_activity_name;
    $activity->a_activity_description = $request->a_activity_description;
    $activity->created_at = $request->activity_date;
    $activity->a_collaboration_name = $c_name;
    $activity->a_activity_PIC = $request->a_activity_PIC;
    $activity->save();

    return redirect()->back()->with('success', 'Activity added successfully.');
}
}