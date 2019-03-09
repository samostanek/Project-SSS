const express = require("express");

const port = 3000;

const app = express();

app.set("view engine", "ejs");

app.use((req, res, next) => {
  console.log(
    "Request from: " + req.ip + "and path: " + req.path + " " + req.method
  );
});

app.use(express.static("public"));

app.get("/", (req, res) => {
  res.sendFile(__dirname + "/index.html");
});

app.listen(port, () => console.log("listening on port: " + port));
