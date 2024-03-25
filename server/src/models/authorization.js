const { default: mongoose, Schema } = require("mongoose");
const bcrypt = require('bcrypt');
const modelOption = require('./modelOption')

const userSchema = new Schema(
    {
        fullName: {
            type: String,
        },
        userName: {
            type: String,
            required: true,
            unique: true,
        },
        email: {
            type: String,
            required: true,
            unique: true,
        },
        password: {
            type: String,
            required: true,
        },
        role: {
            type: Schema.Types.ObjectId,
            ref: 'Role'
        }
    },modelOption
)
userSchema.pre('validate', async function(next) {
    const user = this;
    if (!user.isModified('password')) return next();
    try {
        const salt = await bcrypt.genSalt(10);
        const hash = await bcrypt.hash(user.password, salt);
        user.password = hash;
        next();
    } catch (error) {
        next(error);
    }
});

userSchema.methods.comparePassword = async function(candidatePassword) {
    try {
        return await bcrypt.compare(candidatePassword, this.password);
    } catch (error) {
        throw error;
    }
};

const roleSchema = new Schema (
    {
        roleName: {
            type: String,
            required: true,
            unique: true
        },
    },modelOption
)

roleSchema.pre('findOneAndDelete', async()=>{
    try{
        const role = this
        await Permission.deleteMany({role:role._id})
        next()
    }catch(error){
        next(error)
    }
})

const permissionSchema = new Schema(
    {
        role: {
            type: Schema.Types.ObjectId,
            ref: 'Role'
        },
        feature: {
            type: String,
            required: true,
            unique: true
        },
        read: {
            type: Boolean,
            required: true
        },
        modify: {
            type: Boolean,
            required: true
        }   
}, modelOption)
const User = mongoose.model('User',userSchema)
const Role = mongoose.model('Role',roleSchema)
const Permission = mongoose.model('Permission',permissionSchema)
module.exports = {
    User,
    Role,
    Permission
}