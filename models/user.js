const mongoose = require("mongoose");

module.exports = mongoose.model(
  "user",
  new mongoose.Schema({
    mail: { type: String, required: true },
    uName: { type: String, required: true },
    pwd: { type: String, required: true },
    registered: { type: Date, default: Date.now },
    verified: { type: Boolean, default: false }
  })
);
