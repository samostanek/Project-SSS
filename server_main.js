const express = require("express");
const session = require("express-session");
const expressLayout = require("express-ejs-layouts");
const mongoose = require("mongoose");
const flash = require("connect-flash");
const util = require("./misc/util");
const passport = require("passport");
const morgan = require("morgan");
const fs = require("fs");
const http = require("http");
const https = require("https");

// Reading config
const config = JSON.parse(fs.readFileSync("config.json", "utf8"));
if (config.https)
  var credentials = {
    key: fs.readFileSync(config.privkey, "utf8"),
    cert: fs.readFileSync(config.cert, "utf8")
  };

if (config.https) var sport = config.sport;
const port = config.port;

require("./misc/passport")(passport);

const app = express();

const errShort = process.argv.indexOf("errShort") != -1;

//Connect to mongodb with retry
var connectWithRetry = function() {
  return mongoose.connect(config.credentials, { useNewUrlParser: true }, function(err) {
    if (err) {
      console.error("Failed to connect to mongo on startup - retrying in 5 sec");
      if (!errShort) console.error(err);
      setTimeout(connectWithRetry, 5000);
    } else {
      console.log("Successfully connected to database.");
      util.log("SERVER", "STARTUP", "Successfully connected to DB", {});
    }
  });
};
connectWithRetry();

if (config.https) {
  app.use(function(req, res, next) {
    if (!req.secure) {
      res.redirect("https://" + req.headers.host + req.url);
    } else next();
  });
}
//Publics
app.use(express.static("public"));

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

// Connection logging
app.use(morgan(":date - :method - :url - :remote-addr - :status - :response-time"));
app.use((req, res, next) => {
  util.log("SERVER", "REQUEST", "", {
    request_method: req.method,
    ip: req.ip,
    path: req.path,
    username: req.user ? req.user.uName : null,
    userID: req.user ? req.user._id : null,
    status: res.statusCode
  });
  next();
});

// Connect flash
app.use(flash());

// Routers
app.use("/user", require("./routes/user"));
app.use("/", require("./routes/index"));

var httpServer = http.createServer(app);
if (config.https) var httpsServer = https.createServer(credentials, app);

httpServer.listen(port);
if (config.https) httpsServer.listen(sport);
console.log("Listening on port: " + port);
