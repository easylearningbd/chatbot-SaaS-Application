<?php

namespace App\Jobs;

use App\Services\GeminiApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\KnowledgeDocument; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log; 
use App\Models\KnowledgeChunk; 
 
class ProcessKnowledgeDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected KnowledgeDocument $document;

    /**
     * Create a new job instance.
     */
    public function __construct(KnowledgeDocument $document)
    {
        $this->document = $document;
    }

    /**
     * Execute the job.
     */
    public function handle(GeminiApiService $geminiService): void
    {
       try {

        /// Update document status to processing

        $this->document->update(['status' => 'processing']);

        $content = Storage::disk('public')->get($this->document->file_path);

        $chunkSize = 500; // Characters
        $overlap = 100; // Characters
        $chunks = $this->splitIntoChunks($content,$chunkSize,$overlap);

    //// get embedding for each chunk and store to KnowledgeChunk
        



       } catch (\Throwable $th) {
        //throw $th;
       }



    }



}
