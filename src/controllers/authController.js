const { User, Role, Permission } = require('../models')
const jwt = require("jsonwebtoken");

exports.register = async(req,res)=>{
    try{
        const {fullName, userName, password, email,roleId} = req?.body
        if(!fullName || !userName || !password || !email || !roleId)
            return res.status(400).json("Please fill all the required field!")
        const role = await Role.findById(roleId)
        if(!role)
            return res.status(400).json("Invalid role Id")
        const createdUser = await User.create({ userName, password, email, role: roleId})
        return res.status(200).json({
            message: 'create user successfully',
            data: {
                createdUser,
            }
        })
    }catch(error){
        return res.status(500).json({ error: "Internal Server Error" });
    }
}

exports.login = async(req,res) => {
    try{
        const {userName, password} = req?.body
        if(!userName || !password)
            return res.status(400).json("Please fill all the required field!")
        const user = await User.findOne({userName})
        if(!user)
            return res.status(401).json("Invalid username or password")
        const checkPassword = await user.comparePassword(password)
        if(!checkPassword)
            return res.status(401).json("Invalid username or password")
        const token = jwt.sign(
            {
                id: user._id,
            },
            process.env.TOKEN_SECRET_KEY,
            { expiresIn: '1h'}
            )
        user.password = undefined
        return res.status(200).json({
            message: "login success",
            data:{
                token,
                user
            }
        })
    }catch(error){
        return res.status(500).json({ error: "Internal Server Error" });
    }
}