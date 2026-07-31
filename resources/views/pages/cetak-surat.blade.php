<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak {{ $pengajuan->jenis_surat }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            background-color: #525659;
            display: flex;
            justify-content: center;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            box-sizing: border-box;
            padding: 10mm 15mm;
            margin: 10mm auto;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            body { background: none; }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            .no-print { display: none; }
        }
        .header {
            text-align: center;
            border-bottom: 3px solid black;
            padding-bottom: 5px;
            margin-bottom: 10px;
            position: relative;
        }
        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
        }
        .header h3 { margin: 0; font-size: 13pt; font-weight: normal; }
        .header h2 { margin: 0; font-size: 15pt; font-weight: bold; }
        .header h1 { margin: 0; font-size: 17pt; font-weight: bold; }
        .header p { margin: 0; font-size: 9pt; font-style: italic; }
        
        .title {
            text-align: center;
            margin-bottom: 10px;
        }
        .title h4 {
            margin: 0;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .title p { margin: 0; font-size: 11pt; }
        
        .content { margin-top: 10px; }
        .indent { text-indent: 40px; text-align: justify; margin: 5px 0; }
        
        .data-table {
            margin-left: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .data-table td {
            padding: 2px 0;
            vertical-align: top;
        }
        .data-table td:nth-child(1) { width: 180px; }
        .data-table td:nth-child(2) { width: 10px; }
        
        .signature-section {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            text-align: center;
            width: 250px;
        }
        .signature-name {
            margin-top: 50px;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .footer-note {
            margin-top: 20px;
            font-size: 8pt;
            border: 1px solid black;
            padding: 5px;
            text-align: justify;
        }
        
        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }
        .btn-cetak {
            padding: 10px 20px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .btn-cetak:hover { background: #15803d; }
        
        .btn-pdf {
            padding: 10px 20px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .btn-pdf:hover { background: #b91c1c; }
    </style>
</head>
<body>
    <div class="no-print action-buttons">
        <button class="btn-cetak" onclick="window.print()">🖨️ Cetak Surat</button>
        <button class="btn-pdf" onclick="downloadPDF()">📄 Simpan PDF</button>
    </div>
    
    <div class="page">
        <!-- KOP SURAT -->
        <div class="header">
            <img src="{{ asset('assets/images/logo-desa.png') }}" alt="Logo Kab Serang">
            <h3>PEMERINTAH KABUPATEN SERANG</h3>
            <h3>KECAMATAN KRAGILAN</h3>
            <h1>DESA KRAGILAN</h1>
            <p>Jalan Raya Serang-Jakarta Km. 15 Kragilan Kode Pos 42184</p>
        </div>
        
        <!-- JUDUL SURAT -->
        <div class="title">
            <h4>{{ strtoupper($pengajuan->jenis_surat) }}</h4>
            <p>Nomor : 478 / {{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }} / Ds.2001 / {{ $romans[date('n', strtotime($pengajuan->created_at))] }} / {{ date('Y', strtotime($pengajuan->created_at)) }}</p>
        </div>
        
        <!-- ISI SURAT -->
        <div class="content">
            <p class="indent">
                Menindaklanjuti Surat Pengantar dari Ketua Rukun Tetangga (RT) .... Rukun Warga (RW) .... Kampung ................. Desa Kragilan Nomor : ..... /SP/RT..../..../{{ date('Y') }}, Perihal Surat Pengantar {{ str_replace('Surat Keterangan ', '', $pengajuan->jenis_surat) }}, Dengan ini Kepala Desa Kragilan menerangkan bahwa nama tersebut dibawah ini :
            </p>
            
            <table class="data-table">
                <tr>
                    <td>N a m a</td>
                    <td>:</td>
                    <td><strong>{{ strtoupper($pengajuan->nama_lengkap) }}</strong></td>
                </tr>
                <tr>
                    <td>Tempat, Tgl Lahir/Umur</td>
                    <td>:</td>
                    <td>{{ $pengajuan->tempat_lahir }}, {{ \Carbon\Carbon::parse($pengajuan->tanggal_lahir)->translatedFormat('d-m-Y') }} / {{ \Carbon\Carbon::parse($pengajuan->tanggal_lahir)->age }} Tahun</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $pengajuan->nik }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $pengajuan->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $pengajuan->agama }}</td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td>................................</td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td>Indonesia</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat Asal</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">Kampung</td>
                    <td>:</td>
                    <td>{{ $pengajuan->alamat }}</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">Desa/Kelurahan</td>
                    <td>:</td>
                    <td>KRAGILAN</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">Kecamatan</td>
                    <td>:</td>
                    <td>KRAGILAN</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">Kabupaten/Kota</td>
                    <td>:</td>
                    <td>SERANG</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">Provinsi</td>
                    <td>:</td>
                    <td>BANTEN</td>
                </tr>
            </table>
            
            <p class="indent">
                Menurut Keterangan Ketua Rukun Tetangga (RT) setempat Adalah Benar pada Saat ini bertempat tinggal Kp. ................. RT. ... RW. ... Desa Kragilan Kabupaten Serang yang bersangkutan <strong>Mengontrak / Bertempat Tinggal di Rumah Bapak/Ibu :</strong>
            </p>
            <p style="text-align: center;">--------- ........................................ ---------</p>
            
            <p>Surat Keterangan ini berlaku : <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::now()->addMonths(6)->translatedFormat('d F Y') }}</strong></p>
            <p class="indent">
                Demikian Surat Keterangan ini dibuat agar pihak yang berkepentingan mengetahui dan untuk dipergunakan sebagaimana mestinya.
            </p>
        </div>
        
        <!-- TANDA TANGAN -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Kragilan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>An. Kepala Desa Kragilan</p>
                <p class="signature-name">M. FAUZI AL-GHIFARI</p>
                <p style="margin: 0;">NRPD. 1101 20020515 01</p>
            </div>
        </div>
        
        <!-- CATATAN -->
        <div class="footer-note">
            <u>Catatan:</u><br>
            Surat keterangan ini tidak dapat dipergunakan sebagai bukti dasar untuk proses Izin Nikah / Numpang Nikah Dan Proses transaksi keuangan serta Pengajuan Kredit apapun, apabila hal tersebut dilanggar pihak-pihak tertentu, Tanggung jawab diluar Pemerintah Desa Kragilan.
        </div>
    </div>

    <!-- Script for HTML to PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            var element = document.querySelector('.page');
            
            // Simpan style lama
            var oldMargin = element.style.margin;
            var oldBorder = element.style.border;
            var oldShadow = element.style.boxShadow;
            var oldBorderRadius = element.style.borderRadius;
            
            // Hapus style yang menambah ukuran saat diambil gambarnya oleh html2pdf
            element.style.margin = '0';
            element.style.border = 'none';
            element.style.boxShadow = 'none';
            element.style.borderRadius = '0';

            var opt = {
                margin:       0,
                filename:     'Surat_Keterangan_{{ str_pad($pengajuan->id, 4, "0", STR_PAD_LEFT) }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            
            html2pdf().set(opt).from(element).save().then(function() {
                // Kembalikan style seperti semula
                element.style.margin = oldMargin;
                element.style.border = oldBorder;
                element.style.boxShadow = oldShadow;
                element.style.borderRadius = oldBorderRadius;
            });
        }
    </script>
</body>
</html>
