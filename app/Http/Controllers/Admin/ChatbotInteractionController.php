<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GeminiApiService;
use App\Models\KnowledgeChunk; 
use App\Models\Chatbot;  
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB; 

class ChatbotInteractionController extends Controller
{

    protected GeminiApiService $geminiService;

    public function __construct(GeminiApiService $geminiService){
        $this->geminiService = $geminiService;
    }


    public function Chat(){

    }
    //End Method 




} 
