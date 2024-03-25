const { default: mongoose, Schema } = require("mongoose");
const modelOption = require('./modelOption')
const permissionSchema = new Schema(
    {
    role: {
        type: Schema.Types.ObjectId,
        ref:'Role'
    },
    features: [{
        feature: {
            type: mongoose.Schema.Types.ObjectId,
            ref: 'Feature',
            unique:false
        },
        isRead: {
            type: Boolean,
            default: false
        },
        isInsert: {
            type: Boolean,
            default: false
        },
        isUpdate: {
            type: Boolean,
            default: false
        },
        isDelete: {
            type: Boolean,
            default: false
        }
    }],
},
modelOption
)
module.exports = mongoose.model('permission', permissionSchema)

