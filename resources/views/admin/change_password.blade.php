@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-container">
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex align-items-center">
            <h4 class="header-title">Admin Change Password</h4>
        </div>

        <div class="card-body">
             
<form action="{{ route('admin.password.update') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row g-2">
        
    <div class="mb-3 col-md-8">
        <label for="old_password" class="form-label">Old Password</label>
        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" >
        @error('old_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

 <div class="mb-3 col-md-8">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" >
        @error('new_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

   <div class="mb-3 col-md-8">
        <label for="old_password" class="form-label">Confirm Password</label>
        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" > 
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
