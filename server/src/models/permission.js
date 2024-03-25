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
            ref: 'Feature'
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
permissionSchema.indexes().forEach(async (index) => {
    if (index[0].hasOwnProperty('feature_1')) {
        try {
            await permissionSchema.dropIndex(index[0]);
            console.log(`Index ${index[0]} dropped successfully.`);
        } catch (error) {
            console.error(`Error dropping index ${index[0]}:`, error);
        }
    }
});
module.exports = mongoose.model('permission', permissionSchema)

