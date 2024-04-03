const { default: mongoose, Schema } = require("mongoose");
const modelOption = require('./modelOption')
module.exports = mongoose.model('Feature', new Schema(
    {
    featureName: {
        type: String,
        required: true,
        unique:true
    },
    code: {
        type: String,
        required: true,
        unique:true
    },
    icon: {
        type: String,
        required: true
    }
},
modelOption
))