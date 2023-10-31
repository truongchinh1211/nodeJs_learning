const express = require('express');
const router = express.Router();
const siteController = require('../app/controller/SiteController');


router.use('/trang-chu',siteController.index);

module.exports=router;