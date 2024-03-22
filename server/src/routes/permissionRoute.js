const router = require("express").Router()
const { permissionController } = require('../controllers')
const { authHandler,tokenHandler } = require ('../handlers')
router.get('/feature',permissionController.getFeatures)
router.post('/feature',permissionController.createFeature)
router.get('/permission/:roleId',permissionController.getPermissions)
router.post('/permission',permissionController.createPermission)
module.exports = router