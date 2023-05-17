<?php

use App\Model\DB;
require_once "DB.php";

session_start();
if ($_POST['message'] !== "") {

    require_once 'DB.php';

    $sql = "INSERT INTO message (content, author_id)
            VALUES (:content, :author_id)";
    $stmt = DB::getInstance()->prepare($sql);
    $stmt->bindParam(':content', $_POST['message']);
    $stmt->bindParam(':author_id', $_SESSION['user_id']);

    $stmt->execute();

}
header('location: index.php');