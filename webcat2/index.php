<?php
require_once "configs/DbConn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $AuthorId = isset($_POST['AuthorId']) ? $_POST['AuthorId'] : null;
    $AuthorFullName = isset($_POST['AuthorFullName']) ? $_POST['AuthorFullName'] : null;
    $AuthorEmail = isset($_POST['AuthorEmail']) ? $_POST['AuthorEmail'] : null;
    $AuthorAddress = isset($_POST['AuthorAddress']) ? $_POST['AuthorAddress'] : null;
    $AuthorBiography = isset($_POST['AuthorBiography']) ? $_POST['AuthorBiography'] : null;
    $AuthorDateOfBirth = isset($_POST['AuthorDateOfBirth']) ? $_POST['AuthorDateOfBirth'] : null;
    $AuthorSuspended = isset($_POST['AuthorSuspended']) ? $_POST['AuthorSuspended'] : null;

    if (!empty($AuthorId) && !empty($AuthorFullName) && !empty($AuthorEmail) && !empty($AuthorAddress) && !empty($AuthorBiography) && !empty($AuthorDateOfBirth) && isset($AuthorSuspended)) {
        // Check if the sender's email already exists in the messages table
        $query = "SELECT * FROM authorstb WHERE AuthorId = :AuthorId LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':AuthorId', $AuthorId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Email already exists. Please choose a different one.";
        } else {
            // Insert user data into the messages table
            $insertQuery = "INSERT INTO authorstb (AuthorId, AuthorFullName, AuthorEmail, AuthorAddress, AuthorBiography, AuthorDateOfBirth, AuthorSuspended) VALUES (:AuthorId, :AuthorFullName, :AuthorEmail, :AuthorAddress, :AuthorBiography, :AuthorDateOfBirth, :AuthorSuspended)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->bindParam(':AuthorId', $AuthorId);
            $stmt->bindParam(':AuthorFullName', $AuthorFullName);
            $stmt->bindParam(':AuthorEmail', $AuthorEmail);
            $stmt->bindParam(':AuthorAddress', $AuthorAddress);
            $stmt->bindParam(':AuthorBiography', $AuthorBiography);
            $stmt->bindParam(':AuthorDateOfBirth', $AuthorDateOfBirth);
            $stmt->bindParam(':AuthorSuspended', $AuthorSuspended);

            if ($stmt->execute()) {
                echo "Message sent successfully.";
                header("Location: ../authordb/ViewAuthors.php");
            } else {
                echo "Message sending failed. Please try again.";
            }
        }
    } else {
        echo "All fields are required.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat2</title>
    <link rel="stylesheet" href="CSS/style.css" />
    
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
    }

    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 10px; /* Adjusted padding for a cleaner look */
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        text-align: center; /* Align text to the center within the main container */
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        margin-left: 20px;
    }

    /* Style for email and text input fields */
    input[type="email"],
    input[type="text"],
    textarea {
        width: 65%;
        padding: 10px;
        margin-bottom: 10px;
        border: 2px solid #ccc;
        border-radius: 10px;
        font-size: 16px;
        box-sizing: border-box;
        margin-left: 20px;
    }

    /* Style for the message input field - making it a bit bigger */
    textarea {
        height: 150px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        margin-left: 20px;
    }

    /* Adjust button style on hover */
    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
</head>
<body>
    
 <!-- top navigation starts here -->
 <?php require "navigation.php"; ?>
    <!-- top navigation ends here -->
<div class="header">
    <h1>Talk to Us</h1>
</div>
<!-- the main content section starts here -->
<div class="row">
    <div class="content">
<h3 >Main content</h3>


<form action=" " method="POST">
<form action="processes/AutRegistration.php" method="POST">
    <label for="AuthorId">Author Id:</label><br>
    <input type="text" name="AuthorId" id="AuthorId" placeholder="Enter your Id" maxlength="60" required /><br><br>

    <label for="AuthorFullName">Author Full Name:</label><br>
    <input type="text" name="AuthorFullName" id="AuthorFullName" placeholder="Enter your full name" maxlength="60" /><br><br>

    <label for="AuthorEmail">Author Email:</label><br>
    <input type="email" name="AuthorEmail" id="AuthorEmail" placeholder="Enter your email" maxlength="60" /><br><br>

    <label for="AuthorAddress">Author Address:</label><br>
    <input type="text" name="AuthorAddress" id="AuthorAddress" placeholder="Enter your Address" maxlength="60" /><br><br>

    <label for="AuthorDateOfBirth">Date Of Birth:</label><br>
    <input type="date" name="AuthorDateOfBirth" id="AuthorDateOfBirth" required /><br><br>

    <label for="AuthorBiography">Author Biography:</label><br>
    <textarea name="AuthorBiography" id="AuthorBiography" placeholder="Enter your biography" rows="10" required></textarea><br><br>

      <!-- Hidden input for "not suspended" -->
      <input type="hidden" name="AuthorSuspended" value="0">

    <!-- Checkbox for "suspended" -->
    <input type="checkbox" name="AuthorSuspended" id="AuthorSuspended" value="1">
    <label for="AuthorSuspended">Suspended</label><br><br>
     

    <input type="submit" name="send_AuthorBiography" value="Send AuthorBiography" />
</form>
</div>
<div class="sidebar">
<h3>Side Bar</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
</div>
</div>
<!-- the main content section ends here -->
<div class="footer">
copyright &copy; DBIT 2023
</div>
</body>
</html>
