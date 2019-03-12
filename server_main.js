const express = require("express");
const expressLayout = require("express-ejs-layouts");
const mongoose = require("mongoose");

// const mon

const errShort = process.argv.indexOf("errShort") != -1;
console.log(errShort);

const port = 3000;

const app = express();

//Publics
app.use(express.static("public"));

// Connection logging
app.use((req, res, next) => {
  console.log(
    req.method + " request from: " + req.ip + " and path: " + req.path
  );
  next();
});

//Connect to mongodb

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

app.use("/user", require("./routes/user"));
app.use("/", require("./routes/index"));

app.listen(port, () => console.log("Listening on port: " + port));
