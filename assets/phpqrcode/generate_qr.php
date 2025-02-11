<?php
header('Content-Type: application/json');
include('phpqrcode/qrlib.php'); // Include PHP QR Code library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $website = $_POST['website'];

    // Create vCard format for QR Code
    $vCard = "BEGIN:VCARD\n";
    $vCard .= "VERSION:3.0\n";
    $vCard .= "FN:$name\n";
    $vCard .= "TEL:$phone\n";
    $vCard .= "EMAIL:$email\n";
    $vCard .= "ADR:$address\n";
    if (!empty($website)) {
        $vCard .= "URL:$website\n";
    }
    $vCard .= "END:VCARD";

    // Ensure 'qrcodes' directory exists
    if (!file_exists("qrcodes")) {
        mkdir("qrcodes", 0777, true);
    }

    // Generate QR Code
    $qrFileName = "qrcodes/" . md5($name . time()) . ".png";
    QRcode::png($vCard, $qrFileName, QR_ECLEVEL_L, 4);

    // Return JSON response with QR code URL
    echo json_encode(["success" => true, "qr_url" => $qrFileName]);
} else {
    echo json_encode(["success" => false]);
}
?>
