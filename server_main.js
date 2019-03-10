const express = require("express");
const expressLayout = require("express-ejs-layouts");
const mongoose = require("mongoose");

// const mon

const port = 3000;

const app = express();

// Connection logging
app.use((req, res, next) => {
  console.log(
    req.method + " request from: " + req.ip + " and path: " + req.path
  );
  next();
});

//Connect to mongodb
mongoose
  .connect(
    "mongodb://localhost:27017/storby",
    { useNewUrlParser: true }
  )
  .then(() => console.log("Successfully connected to mongoDB"))
  .catch(err => console.log(err));

//EJS
app.use(expressLayout);
app.set("view engine", "ejs");

//Bodyparser
app.use(express.urlencoded({ extended: false }));

//Publics
app.use(express.static("public"));

app.use("/", require("./routes/index"));
app.use("/user", require("./routes/user"));

app.listen(port, () => console.log("Listening on port: " + port));
