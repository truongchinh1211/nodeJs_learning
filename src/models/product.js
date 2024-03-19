const { default: mongoose, Schema } = require("mongoose");

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
        }  
        },

          {timestamps: true}
)
)