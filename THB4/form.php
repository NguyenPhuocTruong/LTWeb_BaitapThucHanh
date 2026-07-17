<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>b2305616</title>
    <script src="https://kit.fontawesome.com/67ecaf9947.js" crossorigin="anonymous"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: antiquewhite;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        div#table {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            margin-top: 40px;
            font-size: 20px;
            min-width: 50%;
            text-align: center;
        }

        th {
            background-color: burlywood;
        }

        td {
            background-color: beige;
        }

        th, td {
            padding: 10px;
            border: 2px black solid;
        }
    </style>
</head>
<body>
    <form id="form">
        MSSV: <input type="text" name="mssv" id="mssv" required>
        Họ tên: <input type="text" name="hoten" id="hoten" required>
        <button type="button" onclick="themsv()">Thêm</button>
    </form>

    <script>
        function themsv(){
            const mssv = document.getElementById("mssv").value;
            const hoten = document.getElementById("hoten").value;

            if (mssv.length == 0 || hoten.length == 0) alert("Vui lòng nhập đầy đủ thông tin");
            else {
                const xml = new XMLHttpRequest();
                xml.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("table").innerHTML = this.responseText;
                    }
                }
                xml.open("POST", "./them_sinhvien.php", true);
                const formData = new FormData(document.getElementById("form"));
                xml.send(formData);
            }   
        }

        function xoasv(mssv){
            if (confirm("Bạn có chắc chắn muốn xóa sinh viên có mã số: " + mssv + " ?")){
                const xml = new XMLHttpRequest();
                xml.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("table").innerHTML = this.responseText;
                    }
                }
                let url = "./xoa_sinhvien.php?" + encodeURIComponent("mssv") + "=" + encodeURIComponent(mssv);
                xml.open("GET", url, true);
                xml.send();
            }
        }
    </script>

    <div id="table">
        <?php include("./hienthi_sinhvien.php") ?>
    </div>
</body>
</html>