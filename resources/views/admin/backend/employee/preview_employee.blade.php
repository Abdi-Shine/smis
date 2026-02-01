@extends('admin.admin_master')
@section('admin')

<style>
    /* ID Card Styling */
    .id-card-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff;
        width: 85.60mm;
        height: 53.98mm;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 0;
        margin: 20px auto;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .id-card-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 10px;
        text-align: center;
        height: 60px;
    }
    .id-card-header h6 {
        margin: 0;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 14px;
    }
    .id-card-header span {
        font-size: 10px;
        color: #e0e0e0;
    }
    .id-card-body {
        padding: 10px;
        display: flex;
        align-items: center;
        flex: 1;
    }
    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid #f0f0f0;
        object-fit: cover;
        margin-right: 15px;
    }
    .employee-details {
        flex: 1;
    }
    .employee-name {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 2px;
    }
    .employee-position {
        font-size: 12px;
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }
    .detail-row {
        font-size: 10px;
        color: #555;
        margin-bottom: 2px;
    }
    .id-card-footer {
        height: 30px;
        background-color: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 15px;
        border-top: 1px solid #eee;
    }
    .qr-code {
        position: absolute;
        bottom: 45px;
        right: 10px;
        width: 50px;
        height: 50px;
</style>

<div class="page-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row no-print">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Employee ID Card</h4>
                    <div class="page-title-right">
                        <a href="{{ route('download.pdf.employee', $employee->id) }}" class="btn btn-danger waves-effect waves-light"><i class="fa fa-file-pdf"></i> Download PDF</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ID Card Preview -->
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="d-flex flex-column align-items-center gap-4" id="printable-area">
                    
                    <!-- Front Side -->
                    <div class="id-card-container" style="border: 1px solid #ccc;">
                        <!-- Header -->
                        <div class="id-card-front-header d-flex justify-content-between align-items-center" style="padding: 10px 15px 5px;">
                             <!-- Left Text -->
                             <div class="header-text text-start" style="font-size: 8px; font-weight: bold; line-height: 1.2; text-transform: uppercase;">
                                 Jamhuuriyadda Federaalka<br>Soomaaliya<br>Maxkamadda Sare
                             </div>
                             <!-- Center Logo -->
                             <div class="header-logo">
                                 <!-- Placeholder for Shield/Logo -->
                                 <div style="font-size: 24px;">🛡️</div> 
                             </div>
                             <!-- Right Text -->
                             <div class="header-text text-end" style="font-size: 10px; font-weight: bold; line-height: 1.2;">
                                 جمهورية الصومال الفيدرالية<br>المحكمة العليا
                             </div>
                        </div>
                        
                        <div class="text-center" style="font-size: 7px; font-weight: bold; text-transform: uppercase; margin-bottom: 2px;">
                            Somali Federal Republic<br>Supreme Court
                        </div>

                        <!-- Blue Strip -->
                        <div class="blue-strip" style="background-color: #00aeeF; color: white; font-weight: bold; font-size: 10px; padding: 2px 0; width: 100%;">
                            Maxkamadda Sare ee Dalka
                        </div>

                        <!-- Body -->
                        <div class="id-card-body d-flex align-items-start" style="padding: 5px 10px;">
                            <!-- Left: Details -->
                            <div class="details-section text-start" style="flex: 1; padding-right: 5px;">
                                
                                <div class="field-group mb-1">
                                    <div class="field-label" style="font-size: 7px; color: #000; font-weight: bold;">Magaca / Name</div>
                                    <div class="field-value" style="font-size: 10px; font-weight: bold; color: #000; border-bottom: 1px solid #ccc;">{{ $employee->name }}</div>
                                </div>

                                <div class="field-group mb-1">
                                    <div class="field-label" style="font-size: 7px; color: #000; font-weight: bold;">Xilka / Title</div>
                                    <div class="field-value" style="font-size: 9px; font-weight: bold; color: #000; border-bottom: 1px solid #ccc;">{{ $employee->position }}</div>
                                </div>

                                <div class="field-group mb-1">
                                    <div class="field-label" style="font-size: 7px; color: #000; font-weight: bold;">Taxane Aqoonsi / ID No</div>
                                    <div class="field-value" style="font-size: 10px; font-weight: bold; color: #000; border-bottom: 1px solid #ccc;">{{ $employee->id }}</div>
                                </div>
                                
                                <div class="field-group mb-1">
                                    <div class="field-label" style="font-size: 7px; color: #000; font-weight: bold;">Jinsi / Gender</div>
                                    <div class="field-value" style="font-size: 10px; font-weight: bold; color: #000; border-bottom: 1px solid #ccc;">{{ $employee->gender }}</div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="field-group" style="width: 48%;">
                                        <div class="field-label" style="font-size: 6px; color: #000; font-weight: bold;">Tr.Labixiyay/Issue Date</div>
                                        <div class="field-value" style="font-size: 8px; font-weight: bold; color: #000;">{{ $employee->start_date }}</div>
                                    </div>
                                    <div class="field-group" style="width: 48%;">
                                        <div class="field-label" style="font-size: 6px; color: #000; font-weight: bold;">Tr.uu Dhacayo/Expire Date</div>
                                        <div class="field-value" style="font-size: 8px; font-weight: bold; color: #000;">{{ $employee->end_date }}</div>
                                    </div>
                                </div>

                                <div class="field-group mt-1">
                                    <div class="field-label" style="font-size: 7px; color: #000; font-weight: bold;">Saxeex / Signature</div>
                                    <img src="{{ asset('backend/upload/signature.png') }}" style="height: 20px; display: block;">
                                </div>

                            </div>
                            
                            <!-- Right: Photo -->
                            <div class="photo-section" style="width: 90px;">
                                <img src="{{ asset($employee->image) }}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #00aeeF;" alt="Employee Photo">
                            </div>
                        </div>

                        <!-- Footer Strip -->
                        <div class="footer-strip" style="background-color: #00aeeF; color: white; font-weight: bold; font-size: 7px; padding: 2px 0; width: 100%; position: absolute; bottom: 0;">
                            MOQDISHO - SOOMAALIYA
                        </div>
                    </div>

                    <!-- Back Side -->
                    <div class="id-card-container back-side" style="background: white; position: relative; padding: 5px 15px; display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                        <!-- Background Pattern (Optional CSS) -->
                        
                        <!-- Header Logo Area -->
                        <div class="text-center mb-0">
                             <img src="{{ asset('backend/upload/logo.png') }}" style="width: 40px; display: block; margin: 0 auto;">
                        </div>

                        <!-- Disclaimer Text -->
                        <div class="disclaimer-text" style="font-size: 6px; text-align: center; color: #000; font-weight: bold; line-height: 1.1; margin: 2px 0;">
                            Aqoonsigan waxa ogolaatay Maxkamadda Sare ee JFS. Fadlan haddaad hesho kaarkan, la xidhiidh Cinwaannada hoos ku qoran ama gee saldhigga Boolis ee kugu dhaw.
                        </div>

                        <!-- Signature Section -->
                        <div class="signature-section" style="width: 100%; display: flex; justify-content: space-between; align-items: center; margin-top: 2px;">
                             <!-- Chip Image -->
                             <div class="chip" style="width: 25px; height: 20px; background: linear-gradient(135deg, #d4af37 0%, #f9e29c 50%, #d4af37 100%); border-radius: 4px; border: 1px solid #b8860b;"></div>
                             
                             <!-- Signature Text -->
                             <div class="text-center" style="flex: 1;">
                                 <div style="font-family: 'Cursive', sans-serif; font-size: 10px; color: #000080; margin-bottom: 0;">Signature/Saxeex</div>
                                 <img src="{{ asset('backend/upload/signature.png') }}" style="height: 25px; display: block; margin: 0 auto;">
                                 <div style="border-bottom: 1px solid #ccc; width: 80%; margin: 0 auto 1px;"></div>
                                 <div style="font-size: 6px; font-weight: bold;">Xoghayaha Guud ee Maxkamadda Sare</div>
                                 <div style="font-size: 5px;">Secretary General of the Supreme Court</div>
                             </div>
                        </div>

                        <!-- Footer Contact Info -->
                        <div class="footer-text" style="font-size: 5px; text-align: center; margin-top: 2px; font-weight: 600; line-height: 1.1;">
                            If you found, please contact the Supreme Court HQ, Via Londra, Hamarweyne District, kala xariir: Tell: +252 867799 | E-mail: contact@supremecourt.gov.so,
                        </div>

                        <!-- Barcode Area -->
                        <div class="d-flex justify-content-between align-items-center" style="width: 100%; margin-top: 2px;">
                            <!-- Generic Barcode Strip -->
                            <div class="barcode-strip" style="width: 70%; height: 15px; background: repeating-linear-gradient(90deg, #000, #000 1px, #fff 1px, #fff 3px);"></div>
                            <!-- Real QR Code -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('verify.employee', $employee->id) }}" style="width: 30px; height: 30px;" alt="QR">
                        </div>
                        
                        <!-- MRZ Code -->
                        <div class="mrz-text" style="font-family: 'Courier New', monospace; font-size: 8px; text-align: center; width: 100%; letter-spacing: 1px; margin-top: 1px;">
                            &lt;&lt;SEC&lt;&lt; {{ $employee->name }}&gt; CODE&gt;&gt;
                        </div>
                    </div>

                </div>
                <p class="text-muted no-print mt-3">Preview of valid employee identification card (Front & Back).</p>
            </div>
        </div>

        <!-- Full Details Table Removed -->
        <div class="row mt-4 no-print">
            <div class="col-12 text-center">
                 <a href="{{ route('view.employee') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function printIdCard() {
        var printContents = document.getElementById('printable-area').innerHTML;
        
        var w = window.open('', '', 'height=900,width=800');
        w.document.write('<html><head><title>Print ID Card</title>');
        
        // Copy Styles
        var styles = document.querySelectorAll('style, link[rel="stylesheet"]');
        for (var i = 0; i < styles.length; i++) {
             w.document.write(styles[i].outerHTML);
        }

        // Force Print Colors & Layout
        w.document.write('<style>');
        w.document.write('* { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }');
        w.document.write('body { background-color: #fff; display: flex; flex-direction: column; align-items: center; justify-content: start; pt-5; margin: 0; }');
        w.document.write('.id-card-container { margin: 20px auto; border: 1px solid #000; box-shadow: none; page-break-inside: avoid; }');
        // Ensure background colors print
        w.document.write('.blue-strip { background-color: #00aeeF !important; color: white !important; }');
        w.document.write('.footer-strip { background-color: #00aeeF !important; color: white !important; }');
        w.document.write('</style>');
        
        w.document.write('</head><body>');
        w.document.write(printContents);
        w.document.write('</body></html>');
        
        w.document.close();
        w.focus();
        
        // Slightly longer timeout to ensure images/styles load
        setTimeout(function() {
            w.print();
            w.close();
        }, 1000);
    }
</script>
@endsection
