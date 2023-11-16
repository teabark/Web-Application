<?php
require_once "../configs/DbConn.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["send_AuthorBiography"])) {
    $AuthorId = filter_var($_POST["AuthorId"], FILTER_SANITIZE_STRING);
    $AuthorFullName = filter_var($_POST["AuthorFullName"], FILTER_SANITIZE_STRING);
    $AuthorEmail = filter_var($_POST["AuthorEmail"], FILTER_VALIDATE_EMAIL);
    $AuthorAddress = addslashes($_POST["AuthorAddress"]);
    $AuthorBiography = addslashes($_POST["AuthorBiography"]);
    $AuthorDateOfBirth = addslashes($_POST["AuthorDateOfBirth"]);
    $AuthorSuspended = $_POST["AuthorSuspended"];  // Assuming it's a boolean value

    // Validate the email and ID
    if (!$AuthorEmail || !filter_var($AuthorId, FILTER_VALIDATE_INT)) {
        die("Invalid email address or ID");
    }

    $stmt = $pdo->prepare("INSERT INTO authorstb (AuthorId, AuthorFullName, AuthorEmail, AuthorAddress, AuthorBiography, AuthorDateOfBirth, AuthorSuspended) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$AuthorId, $AuthorFullName, $AuthorEmail, $AuthorAddress, $AuthorBiography, $AuthorDateOfBirth, $AuthorSuspended]);

    header("Location: ../authordb/ViewAuthors.php");
    exit();
}

if (isset($_POST["update_AuthorBiography"])) {
    $AuthorId = filter_var($_POST["AuthorId"], FILTER_VALIDATE_INT);
    $AuthorFullName = filter_var($_POST["AuthorFullName"], FILTER_SANITIZE_STRING);
    $AuthorEmail = filter_var($_POST["AuthorEmail"], FILTER_VALIDATE_EMAIL);
    $AuthorAddress = addslashes($_POST["AuthorAddress"]);
    $AuthorBiography = addslashes($_POST["AuthorBiography"]);
    $AuthorDateOfBirth = addslashes($_POST["AuthorDateOfBirth"]);
    $AuthorSuspended = addslashes($_POST["AuthorSuspended"]);

    // Validate the email and ID
    if (!$AuthorEmail || !$AuthorId) {
        die("Invalid email address or ID");
    }

    $stmt = $pdo->prepare("UPDATE authorstb SET AuthorId=?, AuthorFullName=?, AuthorEmail=?, AuthorAddress=?, AuthorBiography=?, AuthorDateOfBirth=?, AuthorSuspended=? WHERE AuthorId=? LIMIT 1");
    $stmt->execute([$AuthorId, $AuthorFullName, $AuthorEmail, $AuthorAddress, $AuthorBiography, $AuthorDateOfBirth, $AuthorSuspended, $AuthorId]);

    header("Location: ../authordb/ViewAuthors.php");
    exit();
}

if (isset($_GET["DelId"])) {
    $stmt = $pdo->prepare("SELECT * FROM authorstb WHERE AuthorId=? LIMIT 1");
    $stmt->execute([$_GET["DelId"]]);
    $author = $stmt->fetch();

    if ($author) {
        $stmt = $pdo->prepare("DELETE FROM authorstb WHERE AuthorId=?");
        $stmt->execute([$_GET["DelId"]]);

        header("Location: ../ViewAuthors.php");
        exit();
    } else {
        header("Location: ../authordb/ViewAuthors.php");
        exit();
    }
}
?>                     