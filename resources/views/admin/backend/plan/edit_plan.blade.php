@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-container">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex align-items-center">
            <h4 class="header-title">Edit Plans </h4>
        </div>

        <div class="card-body">
             
<form action="{{ route('update.plans') }}" method="post" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="id" value="{{ $plan->id }}">

    <div class="row g-2">
        <div class="mb-3 col-md-6">
            <label for="inputEmail4" class="form-label">Plan Name</label>
            <input type="text" name="name" class="form-control" id="inputEmail4" value="{{ $plan->name }}" >
        </div>
        <div class="mb-3 col-md-6">
      <label for="inputPassword4" class="form-label">Knowledge Base</label>
            <input type="text" name="knowledge_base" class="form-control" value="{{ $plan->knowledge_base }}"  >
        </div>
   

    <div class="mb-3 col-md-6">
        <label for="inputAddress" class="form-label">Chat Bot</label>
        <input type="text" class="form-control" name="chat_bot" value="{{ $plan->chat_bot }}" >
    </div>

     <div class="mb-3 col-md-6">
        <label for="inputAddress" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" value="{{ $plan->price }}">
    </div> 
     

     </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
        </div> <!-- end card-body -->
    </div> <!-- end card-->
</div> <!-- end col -->
</div>



</div>

 




@endsection
