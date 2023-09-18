const path = require('path')
const express = require('express')
const morgan = require('morgan')
const app = express()
const port = 3000

app.use(express.static(path.join(__dirname, 'public')));
//HTTP logger
app.use(morgan('combined'));

//configuration for view engine
app.set('view engine','pug');
app.set('views', path.join(__dirname, 'resources/views'));

app.get('/trang-chu', (req, res) => {
  res.render('pages/home')
})

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})