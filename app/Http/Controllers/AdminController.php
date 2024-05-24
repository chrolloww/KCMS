<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaboration;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_collaboration');
    }

    public function upload(Request $request)
    {

        $collaboration=new collaboration;
        $c_image = $request->file;
        $imagename = time().'.'.$c_image->getClientoriginalExtension();
        $request->file->move('collabimages',$imagename);

        $collaboration->c_image=$imagename;
        $collaboration->c_name=$request->name;
        $collaboration->c_focal_person=$request->focal_person;
        $collaboration->c_type=$request->type;
        $collaboration->c_benefit=$request->benefit;
        $collaboration->c_start_date=$request->start_date;
        $collaboration->c_end_date=$request->end_date;

        $collaboration->save();
        return redirect()->back()->with('message','Collaboration added successfully');

    }
}
