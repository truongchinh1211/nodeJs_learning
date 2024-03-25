const router = require("express").Router()
const { permissionController } = require('../controllers')
const { authHandler,tokenHandler } = require ('../handlers')
router.get('/feature',permissionController.getFeatures)
router.post('/feature',permissionController.createFeature)

router.get('/permission/:roleId',tokenHandler.verifyToken,authHandler.checkPermission('permission'),permissionController.getPermissions)
// router.post('/permission',tokenHandler.verifyToken,authHandler.checkPermission('permission'),permissionController.createPermission)
router.post('/permission',permissionController.createPermission)
router.put('/permission/:roleId',tokenHandler.verifyToken,authHandler.checkPermission('permission'),permissionController.updatePermission)
module.exports = router