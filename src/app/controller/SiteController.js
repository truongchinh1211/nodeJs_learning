class SiteController {

    //  [GET] /
    index(req,res){
        res.render('pages/home');
    }

}

module.exports = new SiteController;