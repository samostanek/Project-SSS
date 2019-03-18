const express = require("express");
const router = express.Router();

const User = require("../models/user");

router.get("/add", (req, res) => {
  res.render("addStory", {
    user: req.body
  });
});

module.exports = router;

// router.post('/add', () => {});