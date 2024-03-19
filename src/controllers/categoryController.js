const { Category } = require('../models')

exports.createCategory = async (req,res)=>{
    try{
        const { categoryName } = req?.body
        if(!categoryName)
            return res.status('400').json("Please enter category name")
        const category = await Category.findOne({
            categoryName: categoryName
        })
        if(category)
            return res.status('400').json("name is already exist")
        const newCategory = await Category?.create({
            categoryName: categoryName,
        })
        return res.status('200').json({
            message:"created successfully",
            data:{newCategory}
        })
    }
    catch(errors){
        console.log(errors)
        return res.status('200').json({ error: "Internal Server Error" })
    }
} 