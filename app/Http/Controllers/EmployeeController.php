<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;

class EmployeeController extends Controller
{
    public function UploadEmployee(){
        return view('admin.backend.employee.upload_employee');
    }

    public function ImportEmployee(Request $request){
        Excel::import(new EmployeeImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Employees Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('view.employee')->with($notification);
    }

    public function ViewEmployee(){
        // Auto-expire employees:
        // 1. If End Date is past (expired).
        // 2. If Start Date is future (not yet active).
        $today = Carbon::now()->format('Y-m-d');
        
        employee::where(function($query) use ($today) {
                    $query->where('end_date', '<', $today)
                          ->orWhere('start_date', '>', $today);
                })
                ->where('status', '1')
                ->update(['status' => '0']);

        $employees = employee::orderBy('employee_id', 'asc')->get();
        return view('admin.backend.employee.view_employee',compact('employees'));
    }

    public function AddEmployee(){
        return view('admin.backend.employee.add_employee');
    }

    // ... (StoreEmployee method remains unchanged) ...

    public function StoreEmployee(Request $request){
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $save_url = null;
        if($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/employee'), $name_gen);
            $save_url = 'upload/employee/'.$name_gen;
        }

        $count = employee::max('id') + 1;
        $generated_id = 'MSO' . $count;

        employee::insert([
            'employee_id' => $generated_id,
            'name' => $request->name,
            'position' => $request->position,
            'gender' => $request->gender,
            'image' => $save_url,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('view.employee')->with($notification);
    }
    
    // ... (EditEmployee, UpdateEmployee, DeleteEmployee, DetailsEmployee, PreviewEmployee remain unchanged) ...

    public function EditEmployee($id){
        $employee = employee::findOrFail($id);
        return view('admin.backend.employee.edit_employee',compact('employee'));
    }

    public function UpdateEmployee(Request $request){
        $employee_id = $request->id;

        if($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/employee'), $name_gen);
            $save_url = 'upload/employee/'.$name_gen;

            employee::findOrFail($employee_id)->update([
                'employee_id' => $request->employee_id,
                'name' => $request->name,
                'position' => $request->position,
                'gender' => $request->gender,
                'image' => $save_url,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'updated_at' => Carbon::now(), 
            ]);

            $notification = array(
                'message' => 'Employee Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.employee')->with($notification);
        } else {

            employee::findOrFail($employee_id)->update([
                'employee_id' => $request->employee_id,
                'name' => $request->name,
                'position' => $request->position,
                'gender' => $request->gender,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'updated_at' => Carbon::now(), 
            ]);

            $notification = array(
                'message' => 'Employee Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.employee')->with($notification);
        }
    }

    public function DeleteEmployee($id){
        $employee = employee::findOrFail($id);
        $img = $employee->image;
        if($img){
             unlink($img);
        }

        employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DetailsEmployee($id){
        $employee = employee::findOrFail($id);
        return view('admin.backend.employee.details_employee',compact('employee'));
    }

    public function PreviewEmployee($id){
        $employee = employee::findOrFail($id);
        return view('admin.backend.employee.preview_employee',compact('employee'));
    }
    
    public function VerifyEmployee($id){
        $employee = employee::findOrFail($id);
        $today = Carbon::now()->format('Y-m-d');

        // Check if expired OR not yet started
        if (($employee->end_date < $today || $employee->start_date > $today) && $employee->status == '1') {
            $employee->update(['status' => '0']);
        }

        return view('frontend.verify_employee',compact('employee'));
    }

    public function DownloadEmployeePDF($id){
        $employee = employee::findOrFail($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.backend.employee.pdf_employee', compact('employee'));
        return $pdf->download('employee_id_card.pdf');
    }

    public function DownloadQRCode($id){
        $url = route('verify.employee', $id);
        $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . $url;
        
        $imageContent = file_get_contents($qr_url);
        
        return response($imageContent)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="qrcode-'.$id.'.png"');
    }
}
