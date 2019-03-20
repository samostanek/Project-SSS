const express = require("express");
const router = express.Router();
const util = require("../misc/util");

const Story = require("../models/story");
const Tag = require("../models/tag");

//Story addition
router.get("/add", (req, res) => {
  if (req.user) {
    res.render("addStory", { uName: req.user.uName });
  } else {
    req.flash("msgError", "You need to be logged in to perform this action.");
    res.redirect("../user/login");
  }
});
router.post("/add", (req, res) => {
  const { founder, title, description, private, tags } = req.body;

  if (!founder || !title) {
    let errors = [];
    errors.push({ msg: "Please fill out founder and title fields" });
    res.render("addStory", { errors });
    const newStory = new Story({
      founder: founder,
      title: title,
      description: description,
      tags: tags,
      private: private,
      followers: [founder]
    });
    newStory
      .save()
      .then(() => {
        req.flash("msg", "Story created succesfully");
        res.redirect("../");
      })
      .catch(err => console.log(err));
  }
});

//Tag addition
router.get("/tag", (req, res) => {
  Tag.find().then(tags => {
    res.render("addTag", { tags: tags });
  });
});
router.post("/tag", (req, res) => {
  Tag.findOne({ name: req.body.tag })
    .then(tag => {
      if (tag) {
        tag.usage++;
        tag
          .save()
          .then(() => {
            Tag.find()
              .then(tags => {
                res.render("addTag", { tags: tags });
              })
              .catch(err => console.log(err));
          })
          .catch(err => console.log(err));
      } else {
        const newTag = new Tag({ name: req.body.tag, usage: 1 });
        newTag
          .save()
          .then(() => {
            Tag.find()
              .then(tags => {
                res.render("addTag", { tags: tags });
              })
              .catch(err => console.log(err));
          })
          .catch(err => console.log(err));
      }
    })
    .catch(err => console.log(err));
});

module.exports = router;

// router.post('/add', () => {});
