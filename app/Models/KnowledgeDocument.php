<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KnowledgeDocument extends Model
{
    protected $guarded = [];

    public function company() : BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function chatbots() {
      return $this->belongsToMany(Chatbot::class, 'chatbot_knowledge_documents');
    }

     public function knowledgeChunks(): HasMany {
        return $this->hasMany(KnowledgeChunk::class);
    }


}
