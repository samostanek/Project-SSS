const express = require("express");
const router = express.Router();
const bcrypt = require("bcryptjs");
const util = require("../misc/util");
const passport = require("passport");
const validator = require("validator");
const fs = require("fs");
const jwt = require("jsonwebtoken");

const PASS = fs
  .readFileSync("./PASS.txt", "utf8")
  .toString()
  .split("\n");

const transporter = require("nodemailer").createTransport({
  host: "smtp.gmail.com",
  port: 587,
  secure: false,
  auth: { user: PASS[1], pass: PASS[2] }
});

const User = require("../models/user");

router.get("/login", (req, res) => {
  if (req.user) {
    console.log(req.user.uName);
    res.render("login", {
      msgError: req.flash("error"),
      msg_success: req.flash("msg_success"),
      uname: req.user.uName
    });
  } else {
    res.render("login", {
      msgError: req.flash("error"),
      msg_success: req.flash("msg_success"),
      uname: null
    });
  }
});
router.post("/login", (req, res, next) => {
  passport.authenticate("local", {
    successRedirect: "../",
    failureRedirect: "./login",
    failureFlash: true
  })(req, res, next);
});

router.get("/logout", (req, res) => {
  util.log("SERVER", "LOGIN", "User has logged out.", {
    ip: req.ip,
    username: req.user.uName,
    userID: req.user._id
  });
  req.logout();
  req.flash("success_msg", "You are logged out");
  res.redirect("./login");
});

router.get("/register", (req, res) => res.render("register", { errors: null, username: null, email: null }));
router.post("/register", (req, res) => {
  const { username, email, pwd, pwdrpt } = req.body;

  var errors = [];
  if (!username || !email || !pwd || !pwdrpt) errors.push({ msg: "Please fill in all fields." });
  if (!validator.isEmail(email)) errors.push({ msg: "Not a valid email." });
  if (pwd !== pwdrpt) errors.push({ msg: "Passwords do not match." });
  if (pwd.length < 5) errors.push({ msg: "Password must be at least 5 characters" });
  if (errors.length > 0) {
    res.render("register", {
      errors: errors,
      username: username,
      email: email
    });
  } else {
    User.findOne({ $or: [{ mail: email }, { uName: username }] })
      .then(user => {
        if (user) {
          // TODO: Differenciate email and username
          errors.push({ msg: "Email or username already taken." });
          util.log("USER", "REGISTER", "User tried to register: failed. Email or username is already taken", {
            ip: req.ip,
            username: user.uName,
            userID: user._id
          });
          res.render("register", { errors, username, email });
        } else {
          const newUser = new User({ uName: username, mail: email, pwd: pwd });
          // Hash Password
          bcrypt.genSalt(12, (err, salt) => {
            if (err) throw error;
            bcrypt.hash(newUser.pwd, salt, (err, hash) => {
              if (err) throw error;
              newUser.pwd = hash;
              newUser
                .save()
                .then(user => {
                  console.log("User " + user.uName + " registered successfully.");
                  util.log("USER", "REGISTER", "User successfully registered.", {
                    ip: req.ip,
                    username: user.uName,
                    userID: user._id
                  });
                  req.flash("msg_success", "You successfully registered!");
                  req.flash("msg_ver", "You have to verify your email before log in.");
                  jwt.sign({ forMail: email }, null, { algorithm: "none" }, (err, token) => {
                    if (err) console.error(err);
                    transporter.sendMail({
                      from: "samostanek@gmail.com",
                      to: email,
                      subject: "Confirm Email",
                      html:
                        "Verify you email by clicking on this link: <a href='storby.hopto.org/user/verification/" +
                        token +
                        "'>storby.hopto.org/user/verification/" +
                        token +
                        "</a>"
                    });
                  });
                  res.redirect("/user/login");
                })
                .catch(err => console.error(err));
            });
          });
        }
      })
      .catch(err => console.error(err));
  }
});

router.get("/verification/:token", (req, res) => {
  jwt.verify(req.params.token, null, { algorithms: ["none"] }, function(err, decoded) {
    console.log(req.params.token);

    if (err) return res.end("Token is not valid: " + err.toString());
    User.update({ mail: decoded.mail }, { verified: true }, (err, raw) => {
      if (err) console.error(err);
    });
  });
  req.flash("msg_success", "Your email was successfully verified");
  res.redirect("/user/login");
});

module.exports = router;
