const express = require("express");
const router = express.Router();
const bcrypt = require("bcryptjs");

const User = require("../models/user");

router.get("/login", (req, res) => {
  res.render("login", { msg: req.flash("msg_success") });
});

router.get("/register", (req, res) => res.render("register"));
router.post("/register", (req, res) => {
  const { username, email, pwd, pwdrpt } = req.body;

  let errors = [];
  if (!username || !email || !pwd || !pwdrpt)
    errors.push({ msg: "Please fill in all fields." });
  if (pwd !== pwdrpt) errors.push({ msg: "Passwords do not match." });
  if (pwd.length < 5)
    errors.push({ msg: "Password must be at least 5 characters" });
  console.log(errors);
  if (errors.length > 0) {
    res.render("register", { errors, username, email });
  } else {
    User.findOne({ mail: email })
      .then(user => {
        if (user) {
          errors.push({ msg: "Email already taken." });
          res.render("register", { errors, username, email });
        } else {
          const newUser = new User({ uName: username, mail: email, pwd: pwd });
          // Hash Password
          bcrypt.genSalt(10, (err, salt) => {
            bcrypt.hash(newUser.pwd, salt, (err, hash) => {
              if (err) throw error;
              newUser.pwd = hash;
              console.log(hash);
              newUser
                .save()
                .then(user => {
                  console.log("User " + username + " registered successfully.");
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
