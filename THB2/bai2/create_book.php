<?php
    isset($_FILES["image_file"]) or die("No data found");
    $image_file = $_FILES["image_file"];

    require_once("mysqlConnect.php");
    $mysqli->select_db("bookstore");

    // check img file
    check_up_load_img_file($image_file);

    // save book to table books
    if (isset($_POST["title"]) and isset($_POST["introduction"])){
        insert_book($_POST["title"], $_POST["introduction"], $mysqli);
    } else {
        echo "Book's information is required";
    }

    // insert book's image to db
    insert_image_to_db($image_file, $mysqli);

    function insert_book(string $title, string $intro, mysqli $mysqli): void {
        $stm = $mysqli->prepare("INSERT INTO books(title, introduction) VALUES(?, ?)");
        $stm->bind_param("ss", $title, $intro);
        if ($stm->execute()){
            echo "The book is inserted successfully! With id = " . $mysqli->insert_id;
        } else echo "Error: " . $stm->error;
        $stm->close();
    }

    function check_up_load_img_file($image_file){
        $php_errors = [
            UPLOAD_ERR_INI_SIZE=>"Maximum file size in php.ini exceeded",
            UPLOAD_ERR_FORM_SIZE=>"Maximum file size in HTML form exceeded",
            UPLOAD_ERR_PARTIAL=>"Only part of the file was uploaded",
            UPLOAD_ERR_NO_FILE=>"No data found"
        ];
        ($image_file['error'] == 0) or die("Cannot upload the image due to: " . $php_errors[$image_file['error']]);
        $imgFileTmpName = $image_file['tmp_name'];
        
        // check if the file was uploaded via http post
        is_uploaded_file($imgFileTmpName) or die("Possible file uploaded attack: $imgFileTmpName");

        // check if the file was an image
        getimagesize($imgFileTmpName) or die("The selected file was not an image file: $imgFileTmpName");
    }

    function insert_image_to_db($image_file, mysqli $mysqli){
        $image_data = file_get_contents($image_file["tmp_name"]) or die("File doesn't exist " . $image_file["tmp_name"]);
        $book_id = $mysqli->insert_id;

        $stm = $mysqli->prepare("INSERT INTO images(book_id, filename, mime_type, file_size, image_data) VALUES(?, ?, ?, ?)");
        $stm->bind_param("issis", $book_id, $image_file["name"], $image_file["type"], $image_file["size"], $image_data);
        if ($stm->execute()) echo "Uploaded image successfully";
        else echo "Fail to upload image due to: " . $stm->error;
        $stm->close();
    }
?>