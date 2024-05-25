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
        $image = $request->file;
        $imagename = time().'.'.$image->getClientoriginalExtension();
        $request->file->move('collabimages',$imagename);

        $collaboration->image=$imagename;
        $collaboration->name=$request->name;
        $collaboration->focal_person=$request->focal_person;
        $collaboration->type=$request->type??'LoI';
        $collaboration->benefit=$request->benefit;
        $collaboration->start_date=$request->start_date;
        $collaboration->end_date=$request->end_date;

        $collaboration->save();
        return redirect()->back()->with('message','Collaboration added successfully');

    }
}
