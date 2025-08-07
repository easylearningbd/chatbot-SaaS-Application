<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\KnowledgeChunk;
use App\Models\Chatbot;
use App\Models\KnowledgeDocument;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage; 
 
class KnowledgeDocumentController extends Controller
{
    public function KnowledgePage(){
        return view('admin.backend.knowledge.knowledge_page');
    }
    /// End Method 

    public function Index(){
        $companyId = Auth::user()->company_id;

        if (!$companyId) {
            return response()->json(['message' => 'User is not associated with a company'], 403);
        }

        $documents = KnowledgeDocument::where('company_id',$companyId )->latest()->get();
        return response()->json($documents);

    }
    /// End Method 

    public function Store(Request $request){

        $request->validate([
            'document_file' => 'required|file|mimes:txt,md|max:2048'
        ]);

        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return response()->json(['message' => 'User is not associated with a company'], 403);
        }

        $companyId = $user->company_id;
        $companySlug = $company->slug;

        $path = 'knowledge_bases/'.$companySlug;
        $fileName = time().'_'.Str::slug(pathinfo($request->file('document_file')->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->file('document_file')->getClientOriginalExtension();
        $filePath = $request->file('document_file')->storeAs($path,$fileName,'public');

        $document = KnowledgeDocument::create([
            'company_id' => $companyId,
            'file_name' => $request->file('document_file')->getClientOriginalName(),
            'file_path' => $filePath,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Document uploaded successfully and pending processing',
            'document' => $document
        ],201);
    
    }
    /// End Method 

    public function DocDelete(KnowledgeDocument $document){

        $user = Auth::user();
        if (!$user->company_id || $document->company_id !== $user->company_id ) {
            return response()->json(['message' => 'Unauthorized or no company associated with this user'],403);
        }

        try {
            
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $document->delete();
            return response()->json(['message' => 'Document deleted successfully.'],200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete document. Plz try again'],500);
        }

    }
     /// End Method 




} 
