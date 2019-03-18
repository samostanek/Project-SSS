const mongoose = require("mongoose");

module.exports = mongoose.model(
  "tag",
  new mongoose.Schema({
    name: { type: String, required: true },
    usage: { type: String, required: true }
  })
);
