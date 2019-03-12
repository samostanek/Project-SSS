const express = require("express");
const session = require("express-session");
const expressLayout = require("express-ejs-layouts");
const mongoose = require("mongoose");
const flash = require("connect-flash");

const port = 3000;

const app = express();

const errShort = process.argv.indexOf("errShort") == -1;
console.log(errShort);

//Publics
app.use(express.static("public"));

// Connection logging
app.use((req, res, next) => {
  console.log(
    req.method + " request from: " + req.ip + " and path: " + req.path
  );
  next();
});

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
      } else console.log("successfully connected.");
    }
  );
};
connectWithRetry();

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

// Connect flash
app.use(flash());

// Routers
app.use("/user", require("./routes/user"));
app.use("/", require("./routes/index"));

app.listen(port, () => console.log("Listening on port: " + port));
