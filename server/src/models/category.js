const { default: mongoose, Schema } = require("mongoose");

module.exports = mongoose.model('category', new Schema(
    {
    categoryName: {
        type: String,
        required: true
    }
},
    {timestamps:true}
))