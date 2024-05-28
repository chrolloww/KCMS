<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Collaboration;
use App\Models\Document;
use App\Models\Staff;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_collaboration');
    }

    public function addview_staff()
    {
        return view('admin.staff.add_staff');
    }

    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'focal_person' => 'required|numeric',
        ],[
            'focal_person.numeric'=>'Staff ID must be a number',
        ]);

        DB::beginTransaction();

        try {
            $collaboration = new Collaboration;

            $collaboration->c_name=$request->name;
            $collaboration->c_focal_person=$request->focal_person;
            $collaboration->c_type=$request->type??'LoI';
            $collaboration->c_benefit=$request->benefit;
            $collaboration->c_start_date=$request->start_date;
            $collaboration->c_end_date=$request->end_date;

            $collaboration->save();

            $document = new Document;

            $d_document_name = $request->file;
            $document_file = time().'.'.$d_document_name->getClientoriginalExtension();
            $request->file->move('collabimages',$document_file);

            $document->d_collaboration_name = $request->name;
            $document->d_document_name = $document_file;

            $document->save();

            DB::commit();

            return redirect()->back()->with('message','Collaboration added successfully');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('message','Collaboration could not be added');
        }

    }

    public function upload_staff(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'staff_id' => 'required|numeric',
        ],[
            'staff_id.numeric'=>'Staff ID must be a number',
        ]);

        $staff = new Staff();
        $staff->s_name = $request->input('name');
        $staff->s_email = $request->input('email');
        $staff->s_staff_id = $request->input('staff_id');

        $staff->save();

        return redirect()->back()->with('message','Collaboration added successfully');
    }
}
