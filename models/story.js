const mongoose = require("mongoose");

module.exports = mongoose.model(
  "story",
  new mongoose.Schema({
    title: { type: String, required: true },
    founder: { type: String, required: true },
    description: { type: String, default: "" },
    tags: { type: Array, default: [] },
    private: { type: Boolean, default: false },
    vote_type: { type: String, default: "OPEN" },
    start_sequels: { type: Array, default: [] },
    comments: { type: Array, default: [] },
    rating: { type: Array, default: [] },
    followers: { type: Array, default: [] }
  })
);
