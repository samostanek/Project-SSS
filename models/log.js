const mongoose = require("mongoose");
const ObjectId = mongoose.Schema.Types.ObjectId;

module.exports = mongoose.model(
  "log",
  new mongoose.Schema({
    time: { type: Date, default: Date.now },
    sys: { type: String, required: true },
    message: { type: String, required: true },
    userID: { type: ObjectId, default: null },
    storyID: { type: ObjectId, default: null }
  })
);
