const router = require("express").Router()
const { authController } = require('../controllers')
const { authHandler,tokenHandler } = require ('../handlers')

//User
router.post('/login',authController.login)
router.post('/register',authController.register)

//Role
router.get('/role',authController.getRoles)
router.post('/role',authController.createRole)
module.exports = router