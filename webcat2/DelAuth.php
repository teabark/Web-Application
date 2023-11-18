<?php

require_once "configs/DbConn.php";

if (isset($_GET["DelId"])) {
    $authorId = $_GET["DelId"];  // Sanitize or validate the input if needed

    $stmt = $pdo->prepare("SELECT * FROM authorstb WHERE AuthorId=? LIMIT 1");
    $stmt->execute([$authorId]);
    $author = $stmt->fetch();

    if ($author) {
        $stmt = $pdo->prepare("DELETE FROM authorstb WHERE AuthorId=?");
        $stmt->execute([$authorId]);

        header("Location: ViewAuthors.php");
        exit();
    } else {
        header("Location: ViewAuthors.php");
        exit();
    }
}
?>

DelAuth.php