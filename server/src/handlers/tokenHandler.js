const jwt = require("jsonwebtoken");
const { User } = require("../models");

const tokenDecode = req => {
    const bearerHeader = req.headers["authorization"];
    if (bearerHeader) {
      const bearer = bearerHeader.split(" ")[1];
      try {
        const tokenDecoded = jwt.verify(bearer, process.env.TOKEN_SECRET_KEY);
        return tokenDecoded;
      } catch (error) {
        return false;
      }
    }
  };

exports.verifyToken = async (req, res, next) => {
    const tokenDecoded = tokenDecode(req);
    if (tokenDecoded) {
      if(Date.now() >= tokenDecoded.exp*1000)
        return res.status(401).json("token has expired, please login again")
      const user = await User.findById(tokenDecoded.id);
      if (!user) 
        return res.status(403).json("Unathorized");
      req.user = user;
      next();
    } else {
      return res.status(401).json("Undecoded token");
    }
  };