const { User, Role, Permission } = require('../models')
const jwt = require("jsonwebtoken");

exports.createUser = async(req,res)=>{
    try{
        const {fullName, userName, password, email,roleId} = req?.body
        if(!fullName || !userName || !password || !email)
            return res.status(400).json("Please fill all the required field!")
        let role = undefined
        if(roleId)
             role = await Role.findById(roleId)
        else
            role = await Role.findOne({ roleName:'User' })
        if(!role)
            return res.status(400).json("Invalid role Id")
        const user = await User.findOne({userName})
        if(user)
            return res.status(400).json("username exist" )
        const createdUser = await User.create({fullName,userName, password, email, role: role._id})
        return res.status(200).json({
            message: 'create user successfully',
            data: {
                createdUser,
            }
        })
    }catch(error){
        return res.status(500).json('Internal Server Errors');
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
            process.env.TOKEN_SECRET_KEY
            ,{expiresIn:3600}
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


exports.getRoles = async(req,res)=>{
    try{
        const roles = await Role.find()
        return res.status(200).json({
            message: "get success",
            roles: roles,
        })
    }catch(error){
        return res.status(500).json({ error: "Internal Server Error" });
    }
}
exports.createRole = async(req,res)=>{
    try{
        const { roleName } = req?.body
        if(!roleName)
            return res.status(400).json("Please fill all the required field!")
        const oldRole = await Role.findOne({roleName})
        const createRole = await Role.create({ roleName })
        return res.status(200).json({
            message: "created role successfully",
            data: createRole
        })
    }catch(error){
        if (error.code === 11000) 
            return res.status(409).json({ error: "Role already exists" })
        return res.status(500).json({ error: error });
    }
}
exports.updateRole = async(req,res)=>{
    try{
        const {roleId} = req.params
        const { roleName } = req.body
        if(!roleName)
            return res.status(400).json({error:"Please fill all the required field!"})
        const updateRole = await Role.findOneAndUpdate({_id:roleId},{roleName},{new:true})
        if (!updateRole)
            return res.status(404).json({ error: "Role not found" });
        return res.status(200).json({
            message: "updated role successfully",
            data: updateRole
        })
    }catch(error){
        if (error.code === 11000) 
            return res.status(409).json({ error: "Role name already exists" })
        return res.status(500).json({ error: error.message });
    }
}
exports.deleteRole = async(req,res)=>{
    try{
        const roleId = req.params.roleId
        if(!roleId)
            return res.status(400).json({error:"Please fill all the required field!"})
        console.log(roleId)
        const deleteResult = await Role.findOneAndDelete({ _id: roleId });
        if (!deleteResult) {
            return res.status(404).json({ error: "Role not found or already deleted." });
        }
        return res.status(200).json({ message: "Delete role successfully." });
    }catch(error){
            return res.status(500).json({ error: error.message });
    }  
}
exports.getUserInfo = async(req,res)=>{
    try{
        const user = req.user
        user.password = undefined
        return res.status(200).json(user)
    }catch(error){
        return res.status(500).json({ error: error });
    }
}
exports.getUsers= async(req,res)=>{
    try{
        const users = await User.find().populate('role')
        return res.status(200).json(users)
    }catch(error){
        return res.status(500).json({ error: error });
    }
}
exports.getUser= async(req,res)=>{
    try{
        const userId = req.params.userId
        const users = await User.findOne({_id:userId}).populate('role')
        return res.status(200).json(users)
    }catch(error){
        return res.status(500).json({ error: error });
    }
}
exports.updateUserInfo = async(req,res)=>{
    try{
        const user = req.user
        const {userName, email,fullName} = req.body
        if(!fullName || !userName || !email)
            return res.status(400).json("Please fill all the required field!")
            const updatedField = {
                ...(fullName !== user.fullName ? { fullName: fullName } : {}),
                ...(userName !== user.userName ? { userName: userName } : {}),
                ...(email !== user.email ? { email: email } : {}),
            };
        const updateUser = await User.findOneAndUpdate({ _id: user._id },updatedField,{new:true}) 
            return res.status(200).json({
                message: "update successfully",
                data:updateUser
            })
    }catch(error){
        if (error.code === 11000) {
            return res.status(400).json("username or email you wanna change has already exist");
        }
        return res.status(500).json({ error: error });
    }
}