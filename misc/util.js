module.exports = {
  log: function(sys, type, msg, optional) {
    const Log = require("../models/log");
    new Log(Object.assign({
      sys: sys,
      type: type,
      message: msg
    }, optional))
      .save()
      .catch(err => console.error(err));
  }
};
