<?php
    require_once("mysqlConnect.php");
    $mysqli->select_db("bookstore");

    try {
        if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET["book_id"])){
            $stm = $mysqli->prepare("SELECT * FROM images WHERE book_id = ?");
            $stm->bind_param("i", $_GET["book_id"]);
            if ($stm->execute()){
                $img = $stm->get_result()->fetch_assoc();
                header("Content-type: " . $img["mimi_type"]);
                header("Content-lenght: " . $img["file_size"]);
                echo $img["image_data"];
            } else echo "Error: " . $stm->error;
        }
    } catch (Exception $e) {
        echo "Sorry ! Somethings went wrong loading the image: " .$e->getMessage();
    }
?>