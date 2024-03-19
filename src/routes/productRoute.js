const router = require("express").Router();
const { productController } = require('../controllers')
router.post("/",productController.createProduct)

module.exports = router;