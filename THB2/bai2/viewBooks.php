<?php
    require("mysqlConnect.php");
    $mysqli->select_db("bookstore");
    $result = $mysqli->query("SELECT * FROM books");

    echo "<table>";
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td><img src=\"showImage.php?book_id=\"" . $row["book_id"] . "></td>";
        echo "<td><b>". $row["title"] . "</b><br>" . $row["introduction"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>