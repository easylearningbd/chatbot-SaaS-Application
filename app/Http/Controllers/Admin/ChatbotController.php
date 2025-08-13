<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Chatbot;
 
class ChatbotController extends Controller
{
    public function ChatbotPage(){
        return view('admin.backend.chatbot.chatbot_page');
    }
    // End Method 

    public function UserChatbotPage(){
        return view('client.backend.chatbot.chatbot_page');
    }
    // End Method 

    public function Index(){

        $companyId = Auth::user()->company_id;
        if (!$companyId) {
           return response()->json(['message' => 'User is not associated with a company'], 403);
        }

        $chatbots = Chatbot::where('company_id',$companyId)
            ->with('knowledgeDocuments')
            ->latest()
            ->get();

        return response()->json($chatbots->map(function ($chatbot){
            return [
                'id' => $chatbot->id,
                'name' => $chatbot->name,
                'status' => $chatbot->status,
                'knowledge_base_name' => $chatbot->knowledgeDocuments->pluck('file_name')->toArray(),
            ];
        }));
    }
     // End Method 

    public function Store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'persona' => 'nullable|string',
            'knowledge_document_ids' => 'nullable|array',
        ]);

        $user = Auth::user();
        $companyId = $user->company_id;

        if (!$companyId) {
            return response()->json(['message' => 'User is not associated with a company'], 403);
        }


        /// Get the current number of Chatbots for this user 
        $currentChatbotsCount = Chatbot::where('company_id',$user->company_id)->count();
        
        // get the limit for the user plan
        $chatBotLimit = $user->plan->chat_bot;

        // Check if the limit has been reached 
        if ($currentChatbotsCount >= $chatBotLimit) {
           return response()->json([
            'message' => 'You have reached your limit of Chatbots for your  current plan. Plz upgrate your Plan for add more.'
           ],403);
        }



        $chatbot = Chatbot::create([
            'company_id' => $companyId,
            'name' => $request->name,
            'persona' => $request->persona,
            'status' => 'active',
        ]);

        if ($request->has('knowledge_document_ids')) {
           $chatbot->knowledgeDocuments()->sync($request->knowledge_document_ids);
        }

        return response()->json([
            'message' => 'Chatbot created successfully',
            'chatbot' => $chatbot->load('knowledgeDocuments')
        ],201);

    }
    // End Method 

    public function DeleteChatbot(Chatbot $chatbot){

        $user = Auth::user();

        if (!$user->company_id ||  $chatbot->company_id !== $user->company_id) {
            return response()->json(['message' => 'Unauthorized or no company associated with this user'], 403);
        }

        try {
            $chatbot->knowledgeDocuments()->detach();
            $chatbot->delete();
            return response()->json(['message' => 'Chatbot deleted successfully'], 200);
        } catch (\Exception $e) {
           return response()->json(['message' => 'Failed to delete chatbot'],500);
        } 
    }
       // End Method 





}
