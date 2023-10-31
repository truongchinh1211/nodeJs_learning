const path = require('path')
const express = require('express')
const morgan = require('morgan')
const app = express()
const port = 3000

//routing prepare
const route = require('./routes')

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
app.set('views', path.join(__dirname, 'resources/views'));

//route init
route(app);

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})