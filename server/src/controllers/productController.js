const { Product } = require('../models')

exports.createProduct = async (req,res) => {
    try{
        const {productName, category} = req?.body;
        if(!productName || !category)
            return res.status(400).json("Please enter your product name and choose a category!")
        const product = await Product?.findOne({productName})
        if(product)
            return res.status(400).json("Name already exist")
            const existingCategory = await Category?.findById(category);
            if (!existingCategory) {
                return res.status(400).json("Invalid category ID");
            }
        const newProduct = await Product?.create({
            productName: productName
        })
        
        return res.status(200).json("created successfully")
    }catch(errors) {
        return res.status(500).json({ error: "Internal Server Error" });
    }
}
