const express = require("express");
const router = express.Router();

router.get("/", (req, res) => {
  res.render("index", {
    user: { name: "a", timeLogged: "2019" }
  });
});

module.exports = router;
