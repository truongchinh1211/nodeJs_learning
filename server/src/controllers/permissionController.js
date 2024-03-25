const { Feature, Permission } = require("../models")
exports.getFeatures = async(req,res)=>{
    try{
        const features = await Feature.find()
        return res.status(200).json(features)
    }catch(error){
        return res.status(500).json({error:error.message});
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
        return res.status(500).json({error:error.mesage});
    }
}
exports.createPermission = async (req, res) => {
    try {
        const { role, features } = req.body;
        if (!role || !features) {
            return res.status(400).json({error:'fill all the field'});
        }
        console.log(features)
        const createdPermission = await Permission.create({
            role: role,
            features: features
        });
        return res.status(200).json({
            message: "Permission created successfully",
            data: createdPermission 
        });
    } catch (error) {
        return res.status(500).json({ error: error.message });
    }
};
exports.updatePermission = async(req,res)=>{

    try{
        const  role = req.params.roleId
        const  features = req.body.features;
        if (!role || !features) {
            return res.status(400).json({error:'fill all the field'});
        }
        const filter = { role: role };
        const update = { features:features};
        const updatedPermission = await Permission.findOneAndUpdate(filter, update, { new: true});
        return res.status(200).json({
            message: "Multiple features updated successfully",
            data: updatedPermission
        });
    }catch(error){
        return res.status(500).json({error:error.message});
    }
}
exports.getPermissions = async(req,res)=>{
    try{
    const roleId = req.params.roleId;
    const permissions = await Permission.findOne({role:roleId})
    console.log(permissions)
    return res.status(200).json(permissions);
    }catch(error){
        return res.status(500).json({error:error.mesage});
    }
}