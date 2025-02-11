<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = htmlspecialchars($_POST['full_name']);
    $age = htmlspecialchars($_POST['age']);
    $phone = htmlspecialchars($_POST['phone']);
    $social_media = htmlspecialchars($_POST['social_media']);
    $email = htmlspecialchars($_POST['email']);

    // Save data to a CSV file (submissions.csv)
    $data = "$full_name, $age, $phone, $social_media, $email\n";
    file_put_contents("submissions.csv", $data, FILE_APPEND);

    // Redirect to the page that displays data (view.php)
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Read data from the file (submissions.csv)
$submissions = file_exists("submissions.csv") ? file("submissions.csv") : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Collection Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        h2 {
            text-align: center;
            color: #334eac;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #334eac;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #334eac;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2c3d8f;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            margin-top: 5px;
        }

        .qr-code {
            text-align: center;
            margin-top: 30px;
        }

        .submission {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .submission:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Data Collection Form</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="25" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" placeholder="+9647706567121" required>
            </div>

            <div class="form-group">
                <label for="social_media">Social Media Username:</label>
                <input type="text" id="social_media" name="social_media" placeholder="Snapchat: @zhir1196" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="example@example.com" required>
            </div>

            <input type="submit" value="Submit">
        </form>

        <h3>Submitted Data</h3>
        <?php
        // Display each submission
        if (!empty($submissions)) {
            foreach ($submissions as $submission) {
                echo "<div class='submission'>$submission</div>";
            }
        } else {
            echo "<p>No submissions yet.</p>";
        }
        ?>

        <div class="qr-code">
            <h3>Scan to View Form Data</h3>
            <img src="generate_qr.php" alt="QR Code" />
        </div>
    </div>

</body>
</html>
