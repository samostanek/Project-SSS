const LocalStrategy = require("passport-local").Strategy;
const mongoose = require("mongoose");
const bcrypt = require("bcryptjs");

const User = require("../models/user");

module.exports = passport => {
  passport.use(
    new LocalStrategy({ usernameField: "email" }, (email, password, done) => {
      console.log("Running local strategy.");
      User.findOne({ email: email }).then(user => {
        if (!user) {
          console.log("Email " + email + " not registered");
          return done(null, false, { message: "Email not registered." });
        }
        // Match Password
        bcrypt.compare(password, user.password, (err, isMatch) => {
          if (err) throw err;
          if (isMatch) {
            console.log("User with email " + email + " logged in.");
            return done(null, user);
          } else {
            console.log("User with email " + email + " has wrong password");
            return done(null, false, { message: "Password incorrect." });
          }
        });
      });
    })
  );
};
