<?php

namespace App\Http\Controllers;
use App\Models\Collaboration;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function view_pdf($c_name) {

        $datas = DB::table('collaborations')
            ->join('documents', 'collaborations.c_name', '=', 'documents.d_collaboration_name')
            ->where('collaborations.c_name', $c_name)
            ->select('collaborations.c_name', 'documents.d_document_name')
            ->groupBy('collaborations.c_name', 'documents.d_document_name')
            ->orderBy('documents.d_document_name', 'desc')
            ->get();

        if (!$datas) {
            Log::error("Collaboration with name {$c_name} not found.");
            return abort(404, 'Collaboration not found');
        }

        //return dd($datas);
        return view('admin.list_collaboration.view_pdf', compact( 'datas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx',
        ]);

        $document = new Document();

        $d_document_name = $request->file;
        $document_file = time().'.'.$d_document_name->getClientoriginalExtension();
        $request->file->move('collabimages',$document_file);

        $document->d_collaboration_name = $request->name;
        $document->d_document_name = $document_file;
        
        $document->save();

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    public function delete($c_name)
    {
        $document = Document::findOrFail($c_name);

        if ($document->file_path && Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        $document->delete();

        return redirect()->back()->with('success', 'File and record deleted successfully');
    }

    public function view_tab($c_name)
    {
        $file = Document::where('c_name', $c_name)->value('d_document_name');

        if (!$file) {
            bort(404, 'PDF file not found');
        }

        $filePath = public_path('collabimages/' . $file);

            if (!file_exists($filePath)) {
                abort(404, 'PDF file not found');
            }

        return response()->file($filePath);
    }
}
