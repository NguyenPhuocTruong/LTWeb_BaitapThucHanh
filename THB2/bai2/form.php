<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="create_book.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="title">Title:</label><br>
            <input type="text" name="title" size="20"><br>
            <label for="introduction">Introduction:</label><br>
            <textarea name="introduction" cols="40" rows="10"></textarea><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <label for="image_file">Book's image:</label>
            <input type="file" name="image_file">
        </fieldset>
        <fieldset>
            <input type="submit" value="Add to bookstore"> <input type="reset" value="Cancel">
        </fieldset>
    </form>
</body>
</html>