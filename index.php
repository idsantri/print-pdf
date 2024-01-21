<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>

</head>

<body>
    <?php
    require_once("dompdf/autoload.inc.php");
    use Dompdf\Dompdf;

    // Buat objek DOMPDF
    $tmp = sys_get_temp_dir();
    $dompdf = new Dompdf([
        'logOutputFile' => '',
        // authorize DomPdf to download fonts and other Internet assets
        'isRemoteEnabled' => true,
        // all directories must exist and not end with /
        'fontDir' => $tmp,
        'fontCache' => $tmp,
        'tempDir' => $tmp,
        'chroot' => $tmp,
    ]);

    // Load HTML yang ingin dijadikan PDF
    // $html = file_get_contents("registrasi-coba.html");
    
    $html = file_get_contents("perjanjian-tibkam.html");

    // Load HTML ke DOMPDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Tampilkan PDF di browser
    $pdfContent = $dompdf->output();
    ?>
    <iframe src="data:application/pdf;base64,<?= base64_encode($pdfContent); ?>"
        style="width:100vw; height:100vh;"></iframe>
</body>

</html>