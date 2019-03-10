const mongoose = require("mongoose");

module.exports = mongoose.model(
  "user",
  new mongoose.schema({
    mail: { type: String, required: True },
    uName: { type: String, required: True },
    pwd: { type: String, required: True },
    registered: { type: Date, default: Date.now }
  })
);
