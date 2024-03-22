

function route(app){
    app.use('/trang-chu', require('./site'));
    app.use('/product',require('./productRoute'))
    app.use('/category',require('./categoryRoute'))
    app.use(('/auth'),require('./authorizationRoute'))
    app.use('/permission',require('./permissionRoute'))
}

module.exports= route;