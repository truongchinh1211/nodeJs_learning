const { Role, Permission, Feature } = require('../models')

exports.checkPermission = (code) => {
    return async (req, res, next) => {
        try{
            const user = req?.user;
            const method = req?.method;
            const feature = await Feature.findOne({code})
            if(!feature)
                return res.status(403).json({ error: 'invalid feature or role' })
            const role = await Role?.findById(user.role)
            const permission = await Permission.findOne({
                role: role,
                features: { $elemMatch: { feature: feature._id } }
            });
            if(!permission)
                return res.status(403).json({ error: 'invalid feature or role' })
            const featurePermission = permission.features.find(item => {
                return item.feature.toString() === feature._id.toString()});
            if(method === 'GET' && !featurePermission.isRead)
                return res.status(403).json({ error: 'permission denied'} )
            if(method === 'POST' && !featurePermission.isInsert)
                return res.status(403).json({ error: 'permission denied'} )
            if(method === 'PUT' && !featurePermission.isUpdate)
                return res.status(403).json({ error: 'permission denied'} )
            if(method === 'DELETE' && !featurePermission.isDELETE)
                return res.status(403).json({ error: 'permission denied'} )
            next(); 
        }catch (error){
            next(error)
        }
    };
};