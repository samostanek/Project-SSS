module.exports = {
  log: function(sys, type, reqtype, uip, reqpath, msg, uname, uid, status) {
    const Log = require("../models/log");
    new Log({
      sys: sys,
      type: type,
      request_method: reqtype,
      ip: uip,
      path: reqpath,
      message: msg,
      username: uname,
      userID: uid,
      status: status
    })
      .save()
      .catch(err => console.error(err));
  }
};
