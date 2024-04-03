const router = require("express").Router()
const { authController } = require('../controllers')
const { authHandler,tokenHandler } = require ('../handlers')

//User
router.post('/login',authController.login)
router.post('/register',authController.createUser)
router.get('/user',tokenHandler.verifyToken,authHandler.checkPermission('account'),authController.getUsers)
router.get('/user/:userId',tokenHandler.verifyToken,authHandler.checkPermission('account'),authController.getUser)
router.post('/user',tokenHandler.verifyToken,authHandler.checkPermission('account'),authController.createUser)
router.get('/user-info',tokenHandler.verifyToken,authController.getUserInfo)
router.post('/user-info',tokenHandler.verifyToken,authController.updateUserInfo)
//Role
router.get('/role',tokenHandler.verifyToken,authHandler.checkPermission('permission'),authController.getRoles)
router.post('/role',tokenHandler.verifyToken,authHandler.checkPermission('permission'),authController.createRole)
router.put('/role/:roleId',tokenHandler.verifyToken,authHandler.checkPermission('permission'),authController.updateRole)
router.delete('/role/:roleId',tokenHandler.verifyToken,authHandler.checkPermission('permission'),authController.deleteRole)

router.get("/check-token", tokenHandler.verifyToken, (req, res) => {
    res.status(200).json(req.user);
  });

module.exports = router