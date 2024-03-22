module.exports = {
    Category: require('./category'),
    Product : require('./product'),
    ...require('./authorization'),
    Feature: require('./feature'),
    Permission: require('./permission'),
}