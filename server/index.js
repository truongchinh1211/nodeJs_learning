const path = require('path')
const express = require('express')
const morgan = require('morgan')
const route = require('./src/routes')
const multer = require('multer');
const fileUpload = require("express-fileupload");
const cors = require("cors");
const cookieParser = require("cookie-parser");
const app = express()

app.use(cookieParser());
//handle form-data or jason
app.use(express.urlencoded({
  extended:true
}));

app.use(express.json());

//handle static file
app.use(express.static(path.join(__dirname, 'public')));

//HTTP logger
app.use(morgan('combined'));

//configuration for view engine
app.set('view engine','pug');
app.set('views', path.join(__dirname, 'src/resources/views'));


//route init
route(app);

module.exports = app;
