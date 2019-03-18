const express = require("express");
const router = express.Router();
const util = require("../misc/util");

const Story = require("../models/story");

router.get("/add", (req, res) => {
  if (req.user) {
    req.flash("msgError", "You need to be logged in to perform this action.");
    res.redirect("../user/login");
  } else {
    res.render("addStory", { uName: req.user.uName });
  }
});

module.exports = router;

// router.post('/add', () => {});
