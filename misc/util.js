module.exports = {
  log: function(sys, msg, uid, sid) {
    const Log = require("../models/log");
    new Log({
      sys: sys,
      message: msg,
      userID: uid,
      storyID: sid
    })
      .save()
      .catch(err => console.error(err));
  }
};
