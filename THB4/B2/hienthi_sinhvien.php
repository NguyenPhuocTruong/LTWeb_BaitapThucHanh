<?php require_once("./mysqlConnect.php") ?>

<?php 
    $result = $mysqli->query("SELECT * FROM sinhvien");
    if ($result->num_rows > 0){
        $tb = "
            <table>
                <tr>
                    <th>STT</th>
                    <th>MaSV</th>
                    <th>Họ Tên</th>
                    <th>Xóa</th>
                </tr>
        ";
        while ($row = $result->fetch_assoc()){
            $stt = $row['stt'];
            $mssv = $row['mssv'];
            $hoten = $row['hoten'];
            $tb .= "
                <tr>
                    <td>$stt</td>
                    <td>$mssv</td>
                    <td>$hoten</td>
                    <td><i class=\"fa-solid fa-xmark\" style=\"color:red; cursor:pointer;\" onclick=\"xoasv($mssv)\"></i></td>
                </tr>
            ";
        }
        $tb .= "</table>";
        echo $tb;
    } else echo "Vui lòng nhập thêm sinh viên";
?>