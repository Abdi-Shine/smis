@extends('admin.admin_master')
@section('admin')
<div class="content">
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Employees</h5>
                        <div>
                            <a href="{{ route('add.employee') }}" class="btn btn-primary btn-sm">Add Employee</a>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key => $item)
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->employee_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->position }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>
                                            <img src="{{ asset($item->image) }}" style="width:70px; height:40px;">
                                        </td>


                                        <td>{{ $item->end_date }}</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge bg-success">Active</span>
                                            @else
                                            <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.employee', $item->id) }}" class="btn btn-success btn-sm" title="Edit"><i class="fas fa-pen"></i></a>
                                            <a href="{{ route('delete.employee', $item->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete"><i class="fas fa-trash"></i></a>
                                            <a href="{{ route('preview.employee', $item->id) }}" target="_blank" class="btn btn-warning btn-sm" title="View Detail"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('qr_code.download', $item->id) }}" target="_blank" class="btn btn-info btn-sm" title="Download"><i class="fas fa-download"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
