const mongoose = require("mongoose");
const ObjectId = mongoose.Schema.Types.ObjectId;

module.exports = mongoose.model(
  "log",
  new mongoose.Schema({
    sys: { type: String, required: true },
    type: { type: String, required: true },
    request_method: { type: String, default: null },
    ip: { type: String, default: null },
    path: { type: String, default: null },
    message: { type: String, default: null },
    username: { type: String, default: null },
    userID: { type: ObjectId, default: null },
    status: { type: String, default: null },
    time: { type: Date, default: Date.now }
  })
);
