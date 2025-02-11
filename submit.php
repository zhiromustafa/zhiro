<?php
include('phpqrcode/qrlib.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = htmlspecialchars($_POST["full_name"]);
    $age = htmlspecialchars($_POST["age"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $social_media = htmlspecialchars($_POST["social_media"]);
    $email = htmlspecialchars($_POST["email"]);

    // Combine form data into a string for QR code
    $qr_data = "Full Name: $full_name\nAge: $age\nPhone: $phone\nSocial Media: $social_media\nEmail: $email";

    // Generate QR code and save it
    $qr_code_path = 'qrcode.png';
    QRcode::png($qr_data, $qr_code_path);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Form - Submit</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS -->
</head>
<body>

<div class="container">
    <header>
        <h1 class="fade">Your QR Code and Submitted Information</h1>
    </header>

    <div class="output">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <!-- Display QR Code -->
            <div class="qr-code">
                <h2 class="fade">Your QR Code:</h2>
                <img src="<?= $qr_code_path ?>" alt="QR Code">
            </div>

            <!-- Display Submitted Information -->
            <div class="submitted-info">
                <h3 class="fade">Submitted Information</h3>
                <p><strong>Full Name:</strong> <?= $full_name ?></p>
                <p><strong>Age:</strong> <?= $age ?></p>
                <p><strong>Phone:</strong> <?= $phone ?></p>
                <p><strong>Social Media:</strong> <?= $social_media ?></p>
                <p><strong>Email:</strong> <?= $email ?></p>
            </div>

        <?php else: ?>
            <p>No data submitted yet. Please fill the form.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>© 2025 Zhiro. All rights reserved.</p>
    </footer>
</div>

</body>
</html>

<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    color: #333;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container */
.container {
    max-width: 800px;
    width: 100%;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Header */
header {
    text-align: center;
    margin-bottom: 30px;
}

h1 {
    color: #334eac; /* Blue color */
    font-size: 2rem;
    animation: fadeIn 2s ease-in-out; /* Fade effect */
}

/* QR Code Section */
.qr-code {
    text-align: center;
    margin-bottom: 30px;
}

.qr-code img {
    max-width: 100%;
    height: auto;
    border: 5px solid #334eac; /* Blue border for the QR code */
    padding: 10px;
    border-radius: 10px;
}

/* Submitted Information */
.submitted-info {
    margin-top: 20px;
}

.submitted-info p {
    font-size: 16px;
    line-height: 1.5;
    color: #333;
}

.submitted-info strong {
    color: #334eac; /* Blue color for labels */
}

/* Footer */
footer {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    color: #888;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h1 {
        font-size: 1.5rem;
    }

    .submitted-info p {
        font-size: 14px;
    }
}

/* Animation for Fade-In Effect */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Fade effect for elements */
.fade {
    animation: fadeIn 1.5s ease-in-out;
}

/* Light Shadow Effect for Cards */
.qr-code, .submitted-info {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
    border-radius: 10px;
    background-color: #f9f9f9;
}
</style>