const {User,Permission,Feature, Role} = require('../models');

const userSeedData = [
    {
        fullName: "Admin User",
        userName: "admin",
        email: "admin@example.com",
        password: "123456",
        role: null // Will be assigned later
    },
    {
        fullName: "Regular User",
        userName: "user",
        email: "user@example.com",
        password: "123456",
        role: null // Will be assigned later
    }
];
const featureSeedData = [
    {
        featureName: "Tài khoản",
        code: "account",
        icon: "fa-solid fa-users"
    },
    {
        featureName: "Phân quyền",
        code: "permission",
        icon: "fas fa-user-lock"
    }
];

const roleSeedData = [
    {
        roleName: "Admin"
    },
    {
        roleName: "User"
    }
];

const createSeeder = async () => {
    try {
        const features = await Feature.insertMany(featureSeedData);
        await Permission.collection.dropIndex('feature_1');
        const roles = await Role.insertMany(roleSeedData);
        const permissions = [];
        roles.forEach(role => {
            features.forEach(feature => {
                permissions.push({
                    role: role._id,
                    features: [{
                        feature: feature._id,
                        isRead: true,
                        isInsert: true,
                        isUpdate: true,
                        isDelete: true
                    }]
                });
            });
        });
        userSeedData.forEach(user => {
            if (user.userName === "admin") {
                user.role = roles.find(role => role.roleName === "Admin")._id;
            } else {
                user.role = roles.find(role => role.roleName === "User")._id;
            }
        });
        await User.insertMany(userSeedData);

        await Permission.insertMany(permissions);

        console.log('Seeded successfully.');
    } catch (error) {
        console.error('Error seeding permissions:', error);
    }
};

module.exports = createSeeder