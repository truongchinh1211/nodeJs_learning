const { Role, Permission } = require('../models')

exports.checkPermission = (feature) => {
    return async (req, res, next) => {
        try{
            const user = req?.user;
            const method = req?.method;
            const role = await Role?.findById(user.role)
            if(!role)
                return res.status(403).json({ error: 'cannot identify user role'})
            const permission = await Permission?.findOne({ role: role._id, feature })
            
            if(!permission)
                return res.status(403).json({ error: 'invalid feature or role' })

            if(method === 'GET' && !permission.read)
                return res.status(403).json({ error: 'permission denied'} )

            if((method === 'POST' || method==='PUT' || method === 'DELETE') && !permission.modify)
            return res.status(403).json({ error: 'permission denied'} )
        
            next(); 
        }catch (error){
            next(error)
        }
        
    };
};