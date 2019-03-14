const LocalStrategy = require("passport-local").Strategy;
const mongoose = require("mongoose");
const bcrypt = require("bcryptjs");
const util = require("./util");

const User = require("../models/user");

module.exports = passport => {
  passport.use(
    new LocalStrategy((email, password, done) => {
      User.findOne({ $or: [{ mail: email }, { uName: email }] }).then(user => {
        if (!user) {
          console.log("Email " + email + " not registered");
          util.log(
            "LOGIN",
            "User tried to login with mail/uName: " + email + ". NOT FOUND"
          );
          return done(null, false, { message: "Email not registered." });
        }
        // Match Password
        bcrypt.compare(password, user.pwd, (err, isMatch) => {
          if (err) throw err;
          if (isMatch) {
            console.log("User with email " + email + " logged in.");
            util.log("LOGIN", "User successfully logged in.", user._id);
            return done(null, user);
          } else {
            console.log("User with email " + email + " has wrong password");
            util.log("LOGIN", "User has wrong password in.", user._id);
            return done(null, false, { message: "Password incorrect." });
          }
        });
      });
    })
  );
  passport.serializeUser(function(user, done) {
    done(null, user.id);
  });

  passport.deserializeUser(function(id, done) {
    User.findById(id, function(err, user) {
      done(err, user);
    });
  });
};
