const newRouter = require('./new');
const siteRouter = require('./site');

function route(app){
    app.get('/trang-chu', siteRouter);
    app.get('/new',newRouter);
}

module.exports= route;