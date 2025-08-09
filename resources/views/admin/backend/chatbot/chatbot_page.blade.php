@extends('admin.admin_dashboard')
@section('admin') 
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" >
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
</head>
<style>
    .loading-spinner {
        display: none;
        text-align: center;
        margin-top: 20px;
    }
    .loading-spinner.active {
        display: block;
    }
</style>

<div class="page-container"> 
<section id="knowledge-base" class="section-content">
<h2 class="mb-2">Your Chatbots </h2>
<p class="text-muted mb-4">Create and manage your AI Chatbots. Each chatbot can be trained on spcific knowledge base.</p>

<div class="card mb-4">
    <div class="card-header"> Cerate New ChatBot </div>
    <div class="card-body">
        <form id="createChatbotForm">
            @csrf
            <div class="mb-3">
                <label for="chatbotName" class="form-label">Chatbot Name</label>
                <input type="text" class="form-control" name="name" id="chatbotName" placeholder="e.g, Web Host Support Bot"   required> 
            </div>

    <div class="mb-3">
        <label for="chatbotPersona" class="form-label">Initial Greeting/Personal</label>
        <textarea class="form-control" name="persona" id="chatbotPersona" rows="3" placeholder="e.g, 'Hello! how ca i assist your with your website?'" required></textarea>
    </div>

    <div class="mb-3">
        <label for="knowledgeDocumentIds" class="form-label">Knowledge Documents (Optional)</label>
         <select class="form-control" name="knowledge_document_ids[]" id="knowledgeDocumentIds" multiple ></select>
    </div>

    <button type="submit" class="btn btn-primary">Create Chatbot</button>
    <div id="createChatbotMessage" class="mt-3"></div> 
        </form> 
    </div> 
</div>

<div class="card">
<div class="card-header"> Existing Chatbots  </div>
<div class="card-body">
    <div class="loading-spinner" id="documentsLoadingSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading....</span>
        </div>
    <p class="mt-2 text-muted">Loading Documents</p>
    </div>
<div id="deleteMessage" class="mt-3"></div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Document Name</th>
            <th>Status</th>
            <th>Uploaded At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="documentsTableBody"> 
        {{-- load all data  --}}
    </tbody>

</table> 
</div> 
</div>


</section>  
</div> 




@endsection