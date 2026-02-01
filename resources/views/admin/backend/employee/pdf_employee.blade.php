<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee ID Card</title>
    <style>
        @page {
            margin: 0;
            size: 210mm 297mm; /* A4 size */
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }
        .id-card-wrapper {
            width: 100%;
            text-align: center;
        }
        .id-card-container {
            width: 85.60mm;
            height: 53.98mm;
            border: 1px solid #000;
            border-radius: 10px; /* DomPDF has limited radius support but we'll try */
            overflow: hidden;
            position: relative;
            background: #fff;
            margin: 0 auto 20px auto;
            page-break-inside: avoid;
        }
        /* Header */
        .id-card-front-header {
            width: 100%;
            padding: 5px 10px 0 10px;
            display: table;
        }
        .header-cell {
            display: table-cell;
            vertical-align: middle;
        }
        .header-text-left {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
            width: 35%;
        }
        .header-text-right {
            font-size: 8px; /* Arabic might need specific font handling in DomPDF */
            font-weight: bold;
            text-align: right;
            width: 35%;
        }
        .header-logo {
            text-align: center;
            width: 30%;
            font-size: 20px;
        }
        .sub-header {
            text-align: center;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: -5px;
            margin-bottom: 2px;
        }
        /* Blue Strip */
        .blue-strip {
            background-color: #00aeeF;
            color: white;
            font-weight: bold;
            font-size: 10px;
            padding: 2px 0;
            text-align: center;
            width: 100%;
        }
        /* Body */
        .id-card-body {
            padding: 5px 10px;
            display: table;
            width: 100%;
        }
        .details-section {
            display: table-cell;
            width: 65%;
            vertical-align: top;
            text-align: left;
        }
        .photo-section {
            display: table-cell;
            width: 35%;
            vertical-align: top;
            text-align: right;
        }
        .field-group {
            margin-bottom: 2px;
        }
        .field-label {
            font-size: 6px;
            color: #000;
            font-weight: bold;
        }
        .field-value {
            font-size: 9px;
            font-weight: bold;
            color: #000;
            border-bottom: 1px solid #ccc;
            display: inline-block;
            width: 95%;
        }
        /* Footer */
        .footer-strip {
            background-color: #00aeeF;
            color: white;
            font-weight: bold;
            font-size: 7px;
            padding: 2px 0;
            width: 100%;
            position: absolute;
            bottom: 0;
            text-align: center;
            left: 0;
        }

        /* Back Side Specifics */
        .back-side {
            padding: 5px 15px; 
        }
        .back-logo {
            text-align: center;
            margin-bottom: 2px;
        }
        .disclaimer-text {
            font-size: 6px;
            text-align: center;
            color: #000;
            font-weight: bold;
            line-height: 1.1;
            margin: 2px 0;
        }
        .signature-section {
            width: 100%;
            margin-top: 5px;
            display: table;
        }
        .chip-cell {
            display: table-cell;
            width: 20%;
            vertical-align: middle;
        }
        .signature-cell {
            display: table-cell;
            width: 80%;
            text-align: center;
            vertical-align: middle;
        }
        .footer-text {
            font-size: 5px;
            text-align: center;
            margin-top: 5px;
            font-weight: 600;
        }
        .barcode-row {
            margin-top: 5px;
            width: 100%;
            display: table;
        }
        .barcode-cell {
            display: table-cell;
            width: 70%;
            vertical-align: middle;
        }
        .qr-cell {
            display: table-cell;
            width: 30%;
            vertical-align: middle;
            text-align: right;
        }
        .mrz-text {
            font-family: 'Courier New', monospace;
            font-size: 8px;
            text-align: center;
            width: 100%;
            letter-spacing: 1px;
            margin-top: 2px;
        }
    </style>
</head>
<body>
    <div class="id-card-wrapper">
        <!-- Front Side -->
        <div class="id-card-container">
            <div class="id-card-front-header">
                <div class="header-cell header-text-left">
                    Jamhuuriyadda Federaalka<br>Soomaaliya<br>Maxkamadda Sare
                </div>
                <div class="header-cell header-logo">
                    <!-- Shield Emoji not great for PDF, ideally use an image. decoding unicode might fail without font -->
                     <span>🛡️</span>
                </div>
                <div class="header-cell header-text-right">
                    <!-- Arabic might render as boxes without fonts, keeping simple for now -->
                    Somali Federal Republic<br>Supreme Court
                </div>
            </div>

            <div class="sub-header">
                Somali Federal Republic<br>Supreme Court
            </div>

            <div class="blue-strip">
                Maxkamadda Sare ee Dalka
            </div>

            <div class="id-card-body">
                <div class="details-section">
                    <div class="field-group">
                        <div class="field-label">Magaca / Name</div>
                        <div class="field-value">{{ $employee->name }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Xilka / Title</div>
                        <div class="field-value">{{ $employee->position }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Taxane Aqoonsi / ID No</div>
                        <div class="field-value">{{ $employee->id }}</div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Jinsi / Gender</div>
                        <div class="field-value">{{ $employee->gender }}</div>
                    </div>
                    
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%;">
                                <div class="field-label">Issue Date</div>
                                <div class="field-value">{{ $employee->start_date }}</div>
                            </td>
                            <td style="width: 50%;">
                                <div class="field-label">Expire Date</div>
                                <div class="field-value">{{ $employee->end_date }}</div>
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top: 2px;">
                        <div class="field-label">Saxeex / Signature</div>
                        <!-- Using public_path for DomPDF -->
                        <img src="{{ public_path('backend/upload/signature.png') }}" style="height: 15px;">
                    </div>
                </div>

                <div class="photo-section">
                    <!-- public_path is crucial for PDF images -->
                    <img src="{{ public_path($employee->image) }}" style="width: 80px; height: 90px; object-fit: cover; border: 2px solid #00aeeF; border-radius: 5px;">
                </div>
            </div>

            <div class="footer-strip">
                MOQDISHO - SOOMAALIYA
            </div>
        </div>

        <!-- Back Side -->
        <div class="id-card-container back-side">
            <div class="back-logo">
                <img src="{{ public_path('backend/upload/logo.png') }}" style="width: 40px;">
            </div>

            <div class="disclaimer-text">
                Aqoonsigan waxa ogolaatay Maxkamadda Sare ee JFS. Fadlan haddaad hesho kaarkan, la xidhiidh Cinwaannada hoos ku qoran ama gee saldhigga Boolis ee kugu dhaw.
            </div>

            <div class="signature-section">
                <div class="chip-cell">
                    <div style="width: 25px; height: 20px; background-color: #d4af37; border: 1px solid #b8860b; border-radius: 3px;"></div>
                </div>
                <div class="signature-cell">
                    <div style="font-size: 10px; color: #000080; margin-bottom: 0;">Signature/Saxeex</div>
                    <img src="{{ public_path('backend/upload/signature.png') }}" style="height: 20px; display: block; margin: 0 auto;">
                    <div style="border-bottom: 1px solid #ccc; width: 80%; margin: 0 auto 1px;"></div>
                    <div style="font-size: 6px; font-weight: bold;">Xoghayaha Guud ee Maxkamadda Sare</div>
                    <div style="font-size: 5px;">Secretary General of the Supreme Court</div>
                </div>
            </div>

            <div class="footer-text">
                If you found, please contact the Supreme Court HQ, Via Londra, Hamarweyne District, kala xariir: Tell: +252 867799 | E-mail: contact@supremecourt.gov.so,
            </div>

            <div class="barcode-row">
                <div class="barcode-cell">
                    <!-- Simulating barcode strip with background pattern is hard in PDF defined this way, using simple color or image if available. Just a black box for now or striped div -->
                    <div style="width: 100%; height: 15px; background-color: #ccc;"></div>
                </div>
                <div class="qr-cell">
                    <!-- QR Code API - for PDF we need absolute URL or base64. API might work if allow_url_fopen is on. -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('verify.employee', $employee->id) }}" style="width: 30px; height: 30px;">
                </div>
            </div>

            <div class="mrz-text">
                &lt;&lt;SEC&lt;&lt; {{ $employee->name }}&gt; CODE&gt;&gt;
            </div>
        </div>
    </div>
</body>
</html>
