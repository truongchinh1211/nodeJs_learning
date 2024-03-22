const { default: mongoose, Schema } = require("mongoose");
const modelOption = require('./modelOption')
module.exports = mongoose.model('permission', new Schema(
    {
    role: {
        type: Schema.Types.ObjectId,
        ref:'Role'
    },
    feature: {
        type: Schema.Types.ObjectId,
        ref:'Feature'
    },
    isInsert: {
        type: Boolean,
        required: true
    },
    isUpdate: {
        type: Boolean,
        required: true
    },
    isDelete: {
        type: Boolean,
        required: true
    },
    isRead: {
        type: Boolean,
        required: true
    },
},
modelOption
))