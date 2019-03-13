const express = require("express");
const session = require("express-session");
const expressLayout = require("express-ejs-layouts");
const mongoose = require("mongoose");
const flash = require("connect-flash");
const util = require("./misc/util");
const passport = require("passport");
const morgan = require("morgan");

const port = 3000;

require("./misc/passport")(passport);

const app = express();

const errShort = process.argv.indexOf("errShort") != -1;

//Connect to mongodb with retry
var connectWithRetry = function() {
  return mongoose.connect(
    "mongodb://localhost:27017/storby",
    { useNewUrlParser: true },
    function(err) {
      if (err) {
        console.error(
          "Failed to connect to mongo on startup - retrying in 5 sec"
        );
        if (!errShort) console.error(err);
        setTimeout(connectWithRetry, 5000);
      } else {
        console.log("successfully connected.");
        util.log("SERVER", "Successfully connected to DB");
      }
    }
  );
};
connectWithRetry();

//Publics
app.use(express.static("public"));

// Connection logging
app.use(
  morgan(":date - :method - :url - :remote-addr - :status - :response-time")
);
app.use((req, res, next) => {
  util.log(
    "SERVER",
    req.method + " request from: " + req.ip + " and path: " + req.path
  );
  next();
});

//EJS
app.use(expressLayout);
app.set("view engine", "ejs");

//Bodyparser
app.use(express.urlencoded({ extended: false }));
app.use(
  session({
    secret: "ojb4yd2q6fv66yl",
    resave: false,
    saveUninitialized: false,
    cookie: { secure: false } // TODO: Set true when doing HTTPS
  })
);

// Passport middleware
app.use(passport.initialize());
app.use(passport.session());

// Connect flash
app.use(flash());

// Routers
app.use("/user", require("./routes/user"));
app.use("/", require("./routes/index"));

app.listen(port, () => console.log("Listening on port: " + port));
