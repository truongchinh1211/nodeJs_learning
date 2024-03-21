const router = require("express").Router()
const { authController } = require('../controllers')
const { authHandler,tokenHandler } = require ('../handlers')


router.get('/login',tokenHandler.verifyToken, authController.login)