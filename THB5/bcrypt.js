const bc = require("bcrypt");

function hashPassword(password) {
    return bc.hash(password, 10);
}

function verifyPassword(userPassword, hashedPassword) {
    return bc.compare(userPassword, hashedPassword);
}

module.exports = {hashPassword, verifyPassword};