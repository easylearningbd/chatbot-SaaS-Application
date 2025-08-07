<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\KnowledgeChunk;
use App\Models\Chatbot;
use App\Models\KnowledgeDocument;
 
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




} 
