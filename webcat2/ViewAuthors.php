<?php
require_once "configs/DbConn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - DBT</title>
    <link rel="stylesheet" href="CSS/style.css" />
</head>
<body>
    <!-- top navigation starts here -->
    <?php require "navigation.php"; ?>
    <!-- top navigation ends here -->
<div class="header">
    <h1>Header</h1>
</div>
<!-- the main content section starts here -->
<div class="row">
    <div class="content">
<h3>Messages List</h3>
<?php
$stmt = $pdo->query("SELECT * FROM authorstb");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
      <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">AuthorId</th>
      <th scope="col">AuthorFullName</th>
      <th scope="col">AuthorEmail</th>
      <th scope="col">AuthorAddress</th>
      <th scope="col">AuthorBiography</th>
      <th scope="col">AuthorDateOfBirth</th>
      <th scope="col">AuthorSuspended</th>
    </tr>
  </thead>
  <tbody>
<?php 
if($messages){
    $sn = 1;
    foreach($messages as $AuthorBiography){
?>
    <tr>
      <th scope="row"><?php print $sn; $sn++; ?></th>
      <td><?php print $AuthorBiography["AuthorId"]; ?></td>
      <td><?php print $AuthorBiography["AuthorFullName"]; ?></td>
      <td><?php print $AuthorBiography["AuthorEmail"]; ?></td>
      <td><?php print $AuthorBiography["AuthorAddress"]; ?></td>
      <td><?php print $AuthorBiography["AuthorDateOfBirth"]; ?></td>
      <td><?php print $AuthorBiography["AuthorSuspended"]; ?></td>

      <td>
        <?php 
        $shown_string = implode(' ', array_slice(str_word_count(addslashes($AuthorBiography["AuthorBiography"]), 2), 0, 10)) . ' ... ' ; 
        //converting the full text into an array storing all words, then slicing the array at the maximum number of words determined by $max_words      
        $shown_string = implode(' ', array_slice(str_word_count(addslashes($AuthorBiography["AuthorBiography"]), 2), 0, 5)) . ' ... ' ; 
        //converting the full text into an array storing all words, then slicing the array at the maximum number of words determined by $max_words      
        print $shown_string; 
        ?>
      </td>

      <td>
        [<a href="EditAuth.php?EditId=<?php print $AuthorBiography["AuthorId"];?>">Edit</a>] 
        [<a href="AutRegistration.php?DelId=<?php print $AuthorBiography["AuthorId"];?>" OnClick="return confirm('Are you sure you want to delete the author from the database?');">Del</a>]
      </td>
    </tr>
<?php 
    }
}
?>
  </tbody>
  </table>
  </div>
    <!--<div class="sidebar">
    <h3>Side Bar</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>-->
</div>
<!-- the main content section ends here -->
<div class="footer">
copyright &copy; DBIT 2023
</div>
</body>
</html>




