@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Upload Employee Excel </h4> <br><br>
            
            <form method="post" action="{{ route('import.employee') }}" enctype="multipart/form-data">
                @csrf

             <div class="row mb-3">
                <label for="import_file" class="col-sm-2 col-form-label">Xlsx File Import</label>
                <div class="col-sm-10">
           <input name="import_file" class="form-control" type="file" id="import_file">
                </div>
            </div>
            <!-- end row -->

        <div class="row mb-3">
             <div class="col-sm-10 offset-sm-2">
                <a href="{{ url('upload/sample_employee.csv') }}" class="btn btn-warning waves-effect waves-light" download>Download Sample Csv</a>
             </div>
        </div>

<input type="submit" class="btn btn-inverse-info waves-effect waves-light" value="Upload Employees">
            </form>
             
           
        </div>
    </div>
</div> <!-- end col -->
</div>
 


</div>
</div>


@endsection
