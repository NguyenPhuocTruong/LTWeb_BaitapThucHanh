const mysql = require("mysql");

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "thb3"
});

db.connect((err) => {
    if (err) throw err;
    console.log("Connected to \"thb3\" database");
});

module.exports = db;