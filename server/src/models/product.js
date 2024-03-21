const { default: mongoose, Schema } = require("mongoose");
const modelOption = require('./modelOption')

module.exports = mongoose.model("product", new Schema (
    {
        productName: {
            type: String,
            required: true
          },
        category: {
          type : Schema.Types.ObjectId,
          ref : 'category',
          required: true
        },
    },modelOption
)
)