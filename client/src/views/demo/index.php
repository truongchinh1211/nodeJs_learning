
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="./admin_page.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../components/toastNofication/toast.css">
</head>
<style>
    .row.content {
        height: 800px;
        margin-top: 50px;
    }
    
    .navbar {
        margin-bottom: 5px;
    }
    
    .list-group {
        margin-top: 30px;
    }
    
    .list-group-item:hover {
        cursor: pointer;
    }
    
    .sidebar_menu {
        height: 100%;
    }
    
    .product_searchbar {
        width: 400px;
        margin-right: 0;
    }
    
    .product_filter_category, .variant_filter_category {
        padding-right: 0px;
        width: 100px;
    }
    
    .table-product,
    .table-statistical,
    .table-category,
    .table-order,
    .table-account,
    .table-permission,
    .table-variant,
    .table-attribute {
        padding: 0;
        max-height: 520px;
        overflow: auto;
    }
    
    .table-product thead,
    .table-statistical thead,
    .table-category thead,
    .table-order thead,
    .table-account thead,
    .table-permission thead,
    .table-variant thead,
    .table-attribute thead {
        position: sticky;
        top: 0;
        background-color: white;
        box-shadow: 0px 0px 10px 0px #ccc;
    }
    
    .table-overflow {
        height: 300px;
        overflow: auto;
    }
    
    .report-input-config {
        width: 130px;
    }
    
    #category_add_btn {
        margin-bottom: 10px;
    }

    td {
        vertical-align: middle !important;
    }
</style>
<body>

<div id="toast"></div>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
    </svg>
    <!-- <div class="banner alert alert-'.$_GET['alert'].'">'.$_GET['msg'].'</div> -->
    <?php
        if(isset($_GET['msg'])) {
            echo '
                <div class="alert-banner alert alert-'.$_GET['alert'].' d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        '.$_GET['msg'].'
                    </div>
                </div>
            ';
        }            
    ?>

    <div class="tabs report_tab report">
                    <div class="report_tab_heading">
                        <a href="#"id="logout-btn">Đăng xuất </a>
                        <hr>
                    </div>
                    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
            
            </div>
            <div class="col">
            <div class="panel panel-primary" style="display: inline-block;">
                        <div class="panel-heading" style="line-height: 40px;"><h1>option</h1>
                            <!-- <div class="form-inline col-md-5" style="float: right;"> -->
                                
                            <!-- </div> -->
                            <!-- <div class="form-inline col-md-5" style="float: right;"> -->
                                
                            <!-- </div> -->



                        </div>
                        <div class="panel-body table-statistical" style="margin: 30px;">
                        <div class="form-group" style="display: inline-block;">
                                    <button type="button" class="btn btn-success"id="info-btn">Xem thông tin cá nhân</button>
                                </div>
                        <div class="form-group" style="display: inline-block;margin-right:10px">
                                    <button type="button" class="btn btn-danger">Trang admin</button>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="col">
            
            </div>
        </div>
        </div>
                    

    </div>
    <div class="modal fade order_modal" id="order_modal" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Chi tiết đơn hàng</h4>
                                </div>
                                <div class="modal-body oderNoteDetail">
                                    <div class="orderNote-detail">
                                        <form class="row g-3 order_form"id ="info-form">

                                            <div class="col-md-6">
                                            <label for="fullName" class="form-label">full name</label>
                                            <input type="text" name="fullName" class="form-control" id="fullName" >
                                            </div>
                                            <div class="col-md-6">
                                            <label for="email" class="form-label">email</label>
                                            <input type="text" name="email" class="form-control" id="email" >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="userName" class="form-label">user name</label>
                                                <input type="text" name="userName" class="form-control" id="userName" >
                                            </div>
                                            <div class="col-md-12" style="margin-top: 5px;margin-bottom: 10px;">
                                                <label for="order_address" class="form-label" >địa chỉ</label>
                                                <input type="text" class="form-control" id="order_address" readonly>
                                            </div>
                                            <div style="float:right;padding-right:15px">
                                            <button type="button" class="btn btn-primary" id="submit-btn">submit</button>
                                            <button type="button" class="btn btn-link" data-dismiss="modal">close</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

    <script src="../components/toastNofication/toast.js"></script>
    <script src="index.js"></script>
</body>



</html>