const router = require("express").Router()
const { authController } = require('../controllers')
const { authHandler,tokenHandler } = require ('../handlers')

//User
router.post('/login',authController.login)
router.post('/register',authController.register)
router.get('/user',authController.getUsers)
router.get('/user-info',tokenHandler.verifyToken,authController.getUserInfo)
router.post('/user-info',tokenHandler.verifyToken,authController.updateUserInfo)
//Role
router.get('/role',authController.getRoles)
router.post('/role',authController.createRole)
module.exports = router