<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Verification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 50px;
        }
        .verification-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .org-logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .verified-badge {
            font-size: 24px;
            font-weight: bold;
            color: #198754;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .verified-badge i {
            background-color: #198754;
            color: white;
            border-radius: 50%;
            padding: 5px;
            font-size: 16px;
        }
        .details-title {
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .table-details th {
            width: 40%;
            text-align: left;
            color: #6c757d;
            font-weight: 500;
        }
        .table-details td {
            text-align: left;
            color: #6c757d;
        }
        .status-active {
            color: #198754;
            font-weight: bold;
        }
        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="verification-container">
            <!-- Organization Logo -->
             <!-- Employee Image -->
            <img src="{{ (!empty($employee->image)) ? url($employee->image) : url('upload/no_image.jpg') }}" class="org-logo" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 3px solid #e9ecef;" alt="Employee Image">

            <!-- Verified Badge -->
            <div class="verified-badge">
                VERIFIED <i class="fa fa-check"></i>
            </div>

            <!-- Details Title -->
            <div class="details-title">Supreme Court of Somalia</div>

            <!-- Details Table -->
            <table class="table table-bordered table-details">
                <tbody>
                    <tr>
                        <th>ID No:</th>
                        <td>{{ $employee->employee_id }}</td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td>{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <th>Position / Work Station:</th>
                        <td>{{ $employee->position }}</td>
                    </tr>
                    <tr>
                        <th>Issue Date:</th>
                        <td>{{ $employee->start_date }}</td>
                    </tr>
                    <tr>
                        <th>Expire Date:</th>
                        <td>{{ $employee->end_date }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center" style="text-align: center;">
                            @if($employee->status == 1)
                                <h3 class="status-active">Status: Active</h3>
                            @else
                                <h3 class="status-inactive">Status: Expired</h3>
                            @endif
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
