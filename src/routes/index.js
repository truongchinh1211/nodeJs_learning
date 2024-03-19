const newRouter = require('./new');

function route(app){
    app.use('/trang-chu', require('./site'));
    app.use('/new',newRouter);
    app.use('/product',require('./productRoute'))
    app.use('/category',require('./categoryRoute'))
}

module.exports= route;