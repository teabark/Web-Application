<?php
require_once "configs/DbConn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat2</title>
    <link rel="stylesheet" href="CSS/style.css" />
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
<h3>Update Message content</h3>

<?php
if(isset($_GET["EditId"])){
    $stmt = $pdo->prepare("SELECT * FROM authorstb WHERE AuthorId=? LIMIT 1");
    $stmt->execute([$_GET["EditId"]]);
    $messages = $stmt->fetch();
}
?>

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
     
    <input type="submit" name="update_AuthorBiography" value="Update AuthorBiography" />
    <input type="hidden" name="AuthorId" value="<?php print $AuthorBiography["AuthorId"]; ?>" />
    <a href="ViewAuthors.php">Cancel</a>

    
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







