@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Employee Page </h4> <br><br>
            
            <form method="post" action="{{ route('store.employee') }}" enctype="multipart/form-data">
                @csrf

            <div class="row mb-3">
                <label for="employee_id" class="col-sm-2 col-form-label">Employee ID</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{ $generated_id }}" readonly>
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Employee Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                <label for="position" class="col-sm-2 col-form-label">Position</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="position" id="position">
                </div>
            </div>
            <!-- end row -->

             <div class="row mb-3">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" class="form-select" aria-label="Default select example">
                        <option selected="">Open this select menu</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="start_date" id="start_date">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="end_date" id="end_date">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option selected="">Open this select menu</option>
                        <option value="1">Active</option>
                        <option value="0">Expired</option>
                    </select>
                </div>
            </div>
            <!-- end row -->

             <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Employee Image </label>
                <div class="col-sm-10">
           <input name="image" class="form-control" type="file" id="image">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                 <label for="showImage" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
            <!-- end row -->
<input type="submit" class="btn btn-info waves-effect waves-light" value="Add Employee">
            </form>
             
           
        </div>
    </div>
</div> <!-- end col -->
</div>
 


</div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

@endsection
