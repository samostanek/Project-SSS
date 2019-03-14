const express = require("express");
const router = express.Router();
const bcrypt = require("bcryptjs");
const util = require("../misc/util");
const passport = require("passport");

const User = require("../models/user");

router.get("/login", (req, res) => {
  res.render("login", { msg: req.flash("msg_success") });
});
router.post("/login", (req, res, next) => {
  passport.authenticate("local", {
    successRedirect: "./",
    failureRedirect: "./login",
    failureFlash: true
  })(req, res, next);
});

router.get("/register", (req, res) => res.render("register", { errors: null, username: null, email: null }));
router.post("/register", (req, res) => {
  const { username, email, pwd, pwdrpt } = req.body;

  var errors = [];
  if (!username || !email || !pwd || !pwdrpt)
    errors.push({ msg: "Please fill in all fields." });
  if (pwd !== pwdrpt) errors.push({ msg: "Passwords do not match." });
  if (pwd.length < 5)
    errors.push({ msg: "Password must be at least 5 characters" });
  if (errors.length > 0) {
    res.render("register", { errors: errors, username: username, email: email });
  } else {
    User.findOne({ $or: [{ mail: email }, { uName: username }] })
      .then(user => {
        if (user) {
          // TODO: Differenciate email and username
          errors.push({ msg: "Email or username already taken." });
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
                  console.log("User " + username + " registered successfully.");
                  util.log(
                    "REGISTER",
                    "User " + username + " successfully registered."
                  );
                  req.flash("msg_success", "You successfully registered!");
                  res.redirect("/login");
                })
                .catch(err => console.log(err));
            });
          });
        }
      })
      .catch(err => console.log(err));
  }
});

module.exports = router;
