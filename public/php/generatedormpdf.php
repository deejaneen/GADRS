<?php
use Dompdf\Dompdf;
use Dompdf\Options;

require 'vendor/autoload.php';

// Instantiate Dompdf with options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Load the HTML content
$html = file_get_contents('DormReservationFormSheet1.docx.html');
$dompdf->loadHtml($html);

// Set paper size to 8.5 x 13 inches and margins to 0.5 inches
$dompdf->setPaper([0, 0, 8.5 * 72, 13 * 72]); // 8.5in x 13in

// Render the PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Document.pdf", ["Attachment" => false]);