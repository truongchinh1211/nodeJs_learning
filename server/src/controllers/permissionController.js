const { Feature, Permission } = require("../models")

exports.getFeatures = async(req,res)=>{
    try{
        const features = await Feature.find()
        return res.status(200).json(features)
    }catch(error){
        return res.status(500).json('Internal Server Errors');
    }
}

exports.createFeature = async(req,res)=>{
    try{
        const {featureName,code,icon} = req.body
        if(!featureName||!code||!icon)
            return res.status(400).json('fill all the field');
        const createFeature = await Feature.create({featureName,code,icon})
        return res.status(200).json({
            message: "create feature successfully",
            data:createFeature
        })
    }catch(error){
        return res.status(500).json('Internal Server Errors');
    }
}
exports.createPermission = async(req,res)=>{
    try{
        const {role,feature,isInsert,isUpdate,isDelete,isRead} = req.body
        // if (!Array.isArray(data) || data.length === 0)
        //     return res.status(400).json('Invalid data format');
        // console.log(data)
        const createdpermissions = [];
        const createdPermission = await Permission.create({role,feature,isInsert,isUpdate,isDelete,isRead})
        // for (const item of data) {
        //     const {role,feature,isInsert,isUpdate,isDelete,isRead} = item
        //     if(!role ||!feature ||!isInsert ||!isUpdate ||!isDelete ||!isRead)
        //         return res.status(400).json('Missing required fields');
        //     const createPermission = await Permission.create({role,feature,isInsert,isUpdate,isDelete,isRead})
        //     createdpermissions.push(createPermission)
        // }
        return res.status(200).json({
            message: "Multiple features created successfully",
            data: createdPermission
        });
    }catch(error){
        return res.status(500).json('Internal Server Errors');
    }
}
exports.getPermissions = async(req,res)=>{
    try{
    const {roleId} = req.params.roleId;
    const permissions = await Permission.find()
    console.log(permissions)
    return res.status(200).json(permissions);
    }catch(error){
        return res.status(500).json('Internal Server Errors');
    }
}