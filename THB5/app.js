// define hostname and port
const hostname = "localhost";
const port = 6533;

// connect to db
const db = require("./db");

// app express
const express = require("express");
const app = express();
app.set("view engine", "ejs");
app.set("views", "./views");
app.use(express.static("public"));

// use multer middleware to parse form-data (multipart/form-data)
const multer = require("multer");
const upload = multer();
app.use(upload.none()); // In case you need to handle a text-only multipart form, you should use the `.none()` method

// bcrypt for hashing and verify password
const bc = require("bcrypt");

// session
const session = require("express-session");
const e = require("express");
app.use(session({
    secret: "truongadmin",
    resave: false,
    saveUninitialized: true
}));

app.post("/dangky", (req, res) => {
    // get the email then check if this email is existed or not
    const email = req.body.email;
    var exist = false;
    var sql = "SELECT * FROM thanhvien WHERE email = ?";
    db.query(sql, [email], (err, result, fields) => {
        if (err) throw err;
        if (result.length > 0) res.render("dangky", {exist: true});
        else {
            // insert information of user into db
            const name = req.body.name;
            const password = req.body.password;
            const birth = req.body.birth;
            const gender = req.body.gender;
            sql = "INSERT INTO thanhvien (email, hoten, matkhau, namsinh, gioitinh) VALUES (?, ?, ?, ?, ?)";
            db.query(sql, [email, name, password, birth, gender], (err, result) => {
                if (err) throw err;
                // store user information to session
                req.session.email = email;
                req.session.name = name;
                req.session.birth = birth;
                req.session.gender = gender;
                req.session.authenticated = true;

                res.render("thong_tin_ca_nhan", {
                    name: name,
                    email: email,
                    birth: birth,
                    gender: gender
                });
            });
        }
    });
});

app.get("/", (req, res) => {
    if (!req.session.authenticated) res.render("dangky", {exist: false}); // if not logged in then navigate to dangky page
    else res.render("thong_tin_ca_nhan", {
        name: app.session.name, 
        email: app.session.email, 
        birth: app.session.birth, 
        gender: app.session.gender
    });
});

app.listen(port, hostname, (err) => {
    if (err) throw err;
    console.log("Server is running at http://" + hostname + ":" + port + "/");
});