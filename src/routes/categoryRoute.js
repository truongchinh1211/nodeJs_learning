const router = require("express").Router()
const { categoryController } = require('../controllers')
router.post("/",categoryController.createCategory)

module.exports = router