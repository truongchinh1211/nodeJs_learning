class NewController {

    //  [GET] /news
    index(req,res){
        res.render('pages/new');
    }

}

module.exports = new NewController;