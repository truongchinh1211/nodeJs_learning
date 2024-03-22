
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang của Admin</title>
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
    <?php 
        if(isset($_SESSION["account_id-nhom-quyen"]))
        echo '<input type="hidden" id="account_id_nhom_quyen" value='.$_SESSION["account_id-nhom-quyen"].'>';
    ?>
    <!-- toast message -->
    <div id="toast"></div>
    <!-- nav bar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><i class="fa-solid fa-gear"></i> ADMIN PAGE</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="../user-page/index.php">Về shop</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right" id="login-check">
                
                <li id="logout-btn"><a href="#"><span class="glyphicon glyphicon-log-in "></span> Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row content">
            <div class="sidebar_menu col-sm-3 sidenav">
                <div class="list-group sidebar_menu-list">
                    <li class="sidebar_menu-items account list-group-item">
                        <i class="fa-solid fa-users"></i> Tài khoản
                    </li>

                    <li class="sidebar_menu-items permission list-group-item">
                        <i class="fas fa-user-lock"></i> Phân quyền
                    </li>
                </div>
            </div>
            <div class="main_content col-sm-9">
                <div class="tabs category_tab category tab_hide">
                    <div class="category_heading" style="position: relative">
                        <h2>QUẢN LÝ DANH MỤC</h2>
                        <hr>
                        <div class="notification_cate"></div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success" id="category_add_btn" data-toggle="modal" data-target="#category_modal">Thêm danh mục</button>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Danh mục</div>
                        <div class="panel-body table-category" style="margin: 20px;">
                            <table class="table table-hover">
                                <thead class="category_body">
                                    <tr class="category_list_header">
                                        <th class="category_list_items">Mã danh mục</th>
                                        <th class="category_list_items">Tên danh mục</th>
                                        <th class="category_list_items">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="category_list">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade category_modal category_modal_hide" id="category_modal" role="dialog">
                        <div class="modal-dialog category_modal_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-category">Thêm danh mục</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="category_form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="category_id">Mã danh mục <span id="category_id">auto</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_name">Tên danh mục<span style="color: red;">(*)</span></label>
                                            <input class="form-input" type="text" name="ten_danh_muc" id="category_name">
                                            <span class="messege" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer form-btns">
                                        <button type="submit" class="btn btn-success" id="category_confirm_btn">Xác nhận</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="category_cancel_btn">Hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade category_delete_modal category_modal_hide" id="category_delete_modal" role="dialog">
                        <div class="modal-dialog category_modal_form">
                            <div class="modal-content"> 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-category">Xóa danh mục</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="category-delete-form">
                                        <div class="form-group">
                                            <label for="category_id">Mã danh mục</label>
                                            <input class="form-control form-input category_delete_id" type="text" id="category_id" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_name">Tên danh mục</label>
                                            <input class="form-control form-input category_delete_name" type="text" id="category_name" readonly>
                                        </div>
                                            <button type="submit" class="btn btn-success category_confirm_delete_btn" id="category_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="category_cancel_btn">Hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tabs product_tab product tab_hide">
                    <div class="product_tab_heading">
                        <h2>QUẢN LÝ SẢN PHẨM</h2>
                        <hr>
                        <div class="notification_product"></div>
                    </div>
                    <div class="product_search row" style="margin-bottom: 10px;">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" id="product_add_btn">Thêm sản phẩm</button>
                        </div>
                        <div class="product_filter col-md-2" style="position: absolute;left: 600px;">
                            <select class="form-control product_filter_category" style="margin-right: 0;">

                            </select>
                        </div>
                        <div class="product_searchbar input-group col-md-1" style="position: absolute;right: 16px;">
                            <input type="text" class="form-control" id="product_search_input" placeholder="Search" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" id="product_search_btn" type="button"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="product_tab_body">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Sản phẩm</div>
                            <div class="panel-body table-product" style="margin: 20px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="product_list_header">
                                            <th class="product_list_items">Mã sp</th>
                                            <th class="product_list_items">Hình ảnh</th>
                                            <th class="product_list_items">Tên sản phẩm</th>
                                            <th class="product_list_items">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody class="product_list">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <nav aria-label="Page navigation example" class="text-center">
                            <ul class="pagination" id="product_pagination">
                                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                            </ul>
                        </nav>
                        <!-- product_delete_modal -->
                        <div class="modal fade" id="product_delete_modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Xóa sản phẩm</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="product_delete_id">Mã sản phẩm</label>
                                                <input class="form-input form-control" type="text" id="product_delete_id" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_delete_name">Tên sản phẩm</label>
                                                <input class="form-input form-control" type="text" id="product_delete_name" readonly>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success" id="product_confirm_delete_btn">Xác nhận</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="product_cancel_btn">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="product_modal" role="dialog" data-action="add">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title modal-title-product">Thêm sản phẩm</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="product_form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="form-label">ID Sản phẩm: <span id="product_id"></span></label>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="product_name">Tên sản phẩm <span style="color: red;">(*)</span></label>
                                                <input class="form-control form-input" type="text" name="ten_sp" id="product_name" required>
                                                <span class="form-messege"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="product_category_selection">Danh mục <span style="color: red;">(*)</span></label>
                                                <select class="form-control" name="id_danh_muc" id="product_category_selection">
                                                </select>
                                                <span class="form-messege"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="product_quantity">Mô tả <span style="color: red;">(*)</span></label>
                                                <textarea class="form-control form-input" type="text" name="description" id="product_description" required style="height: 90px;"></textarea>
                                                <span class="form-messege"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="product_img">Ảnh sản phẩm</label>
                                                <input class="form-control form-input" type="file" id="product_img">
                                                <input type="hidden" name="img_path_value" id="img_path_value" value="">
                                            </div>
                                            <div class="form-group">
                                                <div id="img_review"></div>
                                            </div>
                                            <div class="modal-footer form-btns">
                                                <button type="submit" class="btn btn-success" id="product_confirm_btn">Xác nhận</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="product_cancel_btn">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs orderNote_tab ordernote tab_hide">
                    <div class="orderNoteTab_heading">
                        <h3 class="orderNote_title">QUẢN LÝ ĐƠN HÀNG</h3>
                        <hr>
                    </div>
                    <div class="orderNote_filter panel panel-primary">
                        <div class="panel-heading">Đơn hàng</div>
                        <div class="panel-body row">
                            <div class="form-group col-md-2" style="margin-left: 230px;">
                                <label for="orderNote_date-from"><small class="text-muted">Khoảng thời gian:</small></label>
                                <input type="date" id="orderNote_date-from" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="orderNote_date-to"><small class="text-muted">đến:</small></label>
                                <input type="date" id="orderNote_date-to" class="form-control">
                            </div>
                            <button class="btn btn-success col-md-1" id="orderNote_date-btn" style="margin-top: 25px;">Lọc</button>
                            <button class="btn btn-success col-md-1" id="orderNote_all-btn" style="margin-top: 25px;margin-left: 20px;">Tất cả</button>
                        </div>
                    </div>


                    <div class="panel panel-primary">
                        <div class="panel-heading">Đơn hàng</div>
                        <div class="panel-body table-order" style="margin: 20px;">
                            <table class="table table-hover orderNoteTab_body">
                                <thead>
                                    <tr class="orderNote_list_header">
                                        <th class="orderNote_list_items">Mã đơn</th>
                                        <th class="orderNote_list_items">Thời gian</th>
                                        <th class="orderNote_list_items">Tình trạng</th>
                                        <th class="orderNote_list_items">Tổng tiền</th>
                                        <th class="orderNote_list_items">Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody class="orderNote_list_content">

                                </tbody>
                            </table>
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
                                        <form class="row g-3 order_form">
                                            <div class="col-md-2">
                                            <label for="order_id" class="form-label">id</label>
                                            <input type="text" class="form-control" id="order_id" readonly>
                                            </div>
                                            <div class="col-md-6">
                                            <label for="order_date" class="form-label">Ngày đặt hàng</label>
                                            <input type="text" class="form-control" id="order_date" readonly>
                                            </div>
                                            <div class="col-md-4">
                                            <label for="order_sdt" class="form-label">số điện thoại</label>
                                            <input type="text" class="form-control" id="order_sdt" readonly>
                                            </div>
                                            <div class="col-md-8">
                                                <label for="order_received" class="form-label">Tên người nhận</label>
                                                <input type="text" class="form-control" id="order_received" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="order_total" class="form-label">Tổng tiền</label>
                                                <input type="text" class="form-control" id="order_total" readonly>
                                            </div>
                                            <div class="col-md-12" style="margin-top: 5px;">
                                                <label for="order_address" class="form-label" >địa chỉ</label>
                                                <input type="text" class="form-control" id="order_address" readonly>
                                            </div>
                                            <div class="col-md-9" style="margin: 10px 0px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="order_status" disabled>
                                                    <label class="custom-control-label" for="order_status">Trạng thái xử lý</label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Chi tiết đơn hàng</div>
                                        <div class="panel-body table-order" style="margin: 20px;">
                                            <table class="table table-hover orderNoteTab_body">
                                                <thead>
                                                    <tr class="orderNote_list_header">
                                                        <th class="orderNote_list_items">mã</th>
                                                        <th class="orderNote_list_items">Tên</th>
                                                        <th class="orderNote_list_items">Đơn giá</th>
                                                        <th class="orderNote_list_items">Số lượng</th>
                                                        <th class="orderNote_list_items">tổng tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="orderNote_list">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="tabs account_tab account tab_hide">
                    <div class="account_tab_heading">
                        <h2>QUẢN LÝ TÀI KHOẢN</h2>
                        <hr>
                        <div class="notification_account"></div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success" id="account_add_btn" data-toggle="modal" data-target="#account_modal" style="margin-bottom: 10px;">Thêm tài khoản</button>
                    </div>
                    <div class="account_tab_body">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Tài khoản</div>
                            <div class="panel-body table-account" style="margin: 20px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="account_list_header">
                                            <th class="account_list_items">Tên tài khoản</th>
                                            <th class="account_list_items">Phân quyền</th>
                                            <th class="account_list_items">Thông tin</th>
                                            <th class="account_list_items">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody class="account_list">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal fade account_modal account_modal_hide" id="account_modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title modal-title-account">Thêm tài khoản</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" class="account_modal_form">
                                            <div class="form-group">
                                                <input type="hidden" id="account_id">
                                                <label class="form-label" for="account_name">Tên tài khoản <span style="color: red;">(*)</span></label>
                                                <input class="form-input form-control" name="username" type="text" id="account_username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="account_email">Email <span style="color: red;">(*)</span></label>
                                                <input class="form-input form-control" name="email" type="text" id="account_email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="account_pass">Mật khẩu <span style="color: red;">(*)</span></label>
                                                <input class="form-input form-control" name="password" type="text" id="account_pass" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="account_type_selection">Loại tài khoản <span style="color: red;">(*)</span></label>
                                                <select id="account_type_selection" name="id_nhom_quyen" class="form-control">
                                                    <option value="0" selected>Khách hàng</option>
                                                    <option value="1">Quản trị</option>
                                                </select>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="account_status">
                                                <label class="form-check-label" for="account_status">
                                                    kích hoạt
                                                </label>
                                            <div class="form-btns">
                                                <button type="submit" class="btn btn-success" id="account_confirm_btn">Xác nhận</button>
                                                <button class="btn btn-danger" id="account_cancel_btn" data-dismiss="modal">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="modal fade account_delete_modal account_modal_hide" id="account_delete_modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Xóa tài khoản</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" class="account_modal_form">
                                            <div class="form-group">
                                                <label class="form-label" for="account_delete_id">Tên tài khoản </label>
                                                <input class="form-input form-control" type="text" id="account_delete_id" required>
                                            </div>
                                            <div class="form-btns">
                                                <button type="submit" class="btn btn-success" id="account_delete_confirm_btn">Xác nhận</button>
                                                <button class="btn btn-danger" id="account_cancel_btn" data-dismiss="modal">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade account_detail_modal account_detail_modal_hide" id="account_detail_modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title modal-title-account_detail">Thêm tài khoản</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" class="account_detail_modal_form">
                                            <div class="form-group">
                                                <label class="form-label" for="account_detail_id">Tên tài khoản <span style="color: red;">(*)</span></label>
                                                <input class="form-input form-control" type="text" id="account_detail_id" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="account_detail_email">Email <span style="color: red;">(*)</span></label>
                                                <input class="form-input form-control" type="text" id="account_detail_email" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="account_detail_pass">Mật khẩu <span style="color: red;">(*)</span></label>
                                                <input class="form-input form-control" type="text" id="account_detail_pass" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="account_detail_type_selection">Loại tài khoản <span style="color: red;">(*)</span></label>
                                                <input type="text" class="form-input form-control" id="account_detail_type_selection" readonly>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tabs report_tab report">
                    <div class="report_tab_heading">
                        <h2>THỐNG KÊ KINH DOANH</h2>
                        <hr>
                    </div>

                    <div class="report_filter panel panel-primary">
                        <div class="panel-heading">Thống kê</div>
                        <div class="panel-body row">
                            <div class="col-md-1"></div>
                            <div class="form-group col-md-2" style="margin-left: 50px; padding: 0;">
                                <label for="report_date_from"><small class="text-muted">Khoảng thời gian:</small></label>
                                <input type="date" id="report_date_from" class="form-control report-input-config">
                            </div>
                            <div class="form-group col-md-2" style="margin-left: -40px; padding: 0;">
                                <label for="report_date_to"><small class="text-muted">đến:</small></label>
                                <input type="date" id="report_date_to" class="form-control report-input-config">
                            </div>
                            <div class="col-md-2"style="margin-left: -50px">
                                <label for="report_filter_category"><small class="text-muted">danh mục:</small></label>
                                <select id="report_filter_category" class="form-control report-input-config" ></select>
                                
                                </select>
                            </div>
                            <div class="col-md-2"style="margin-left: -60px">
                                <label for="report_filter_sort"><small class="text-muted">sắp xếp:</small></label>
                                <select id="report_filter_title" class="form-control report-input-config col-md-2" >
                                    <option value="total">Doanh thu</option>
                                    <option value="quantity">Số Lượng</option>
                                </select>
                            </div>
                            <div class="col-md-2"style="margin-top:15px">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="report_filter_sort" value="ASC" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">Tăng dần</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="report_filter_sort" value="DESC">
                                    <label class="form-check-label" for="flexRadioDefault2"> Giảm dần</label>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <button class="btn btn-success col-md-1" id="report_filter_btn" style="margin-top: 25px; margin-left: -60px">Thống kê</button>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading" style="line-height: 40px;">Sản phẩm
                            <div class="form-inline col-md-5" style="float: right;">
                                <div class="form-group" style="float: right;">
                                    <label for="report_total_income">Tổng doanh thu:</label>
                                    <input type="text" id="report_total_income" class="form-control mx-sm-3" readonly>
                                </div>
                            </div>
                            <div class="form-inline col-md-5" style="float: right;">
                                <div class="form-group" style="float: right;">
                                    <label for="report_total_quantity">Tổng số lượng:</label>
                                    <input type="text" id="report_total_quantity" class="form-control mx-sm-3" readonly>
                                </div>
                            </div>



                        </div>
                        <div class="panel-body table-statistical" style="margin: 20px;">
                            <table class="table table-hover report_tab_body">
                                <thead>
                                    <tr class="report_list_header">
                                        <th class="report_list_items" colspan="2">Sản phẩm</th>
                                        <th class="report_list_items" colspan="1">Số lượng bán ra</th>
                                        <th class="report_list_items" colspan="1">Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody class="report_list">

                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                </div>
                <div class="tabs attribute_tab attribute tab_hide">
                    <div class="attribute_heading" style="position: relative">
                        <h2>QUẢN LÝ THUỘC TÍNH</h2>
                        <hr>
                        <div class="notification_attribute"></div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success" id="attribute_add_btn"style="margin-bottom: 10px;">Thêm thuộc tính</button>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Thuộc tính</div>
                        <div class="panel-body table-attribute" style="margin: 20px;">
                            <table class="table table-hover">
                                <thead class="attribute_body">
                                    <tr class="attribute_list_header">
                                        <th class="attribute_list_items">Mã thuộc tính</th>
                                        <th class="attribute_list_items">Tên thuộc tính</th>
                                        <th class="attribute_list_items text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="attribute_list">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="attribute_modal" role="dialog" data-action="add">
                        <div class="modal-dialog attribute_modal_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-attribute">Thêm thuộc tính</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="attribute_form">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Thông tin thuộc tính</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="variant_id">Mã thuộc tính</label>
                                                        <input class="form-input form-control" name="id" type="text" id="attribute_id" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="attribute_name">Tên thuộc tính</label>
                                                        <input class="form-input form-control" type="text" name="ten_thuoc_tinh" id="attribute_name" required>
                                                        <span class="form-messege"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Các giá trị</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-8">
                                                        <label for="attribute_value">Giá trị</label>
                                                        <input class="form-input form-control" type="text" id="attribute_value">
                                                    </div>
                                                    <div class="btn btn-success col-md-2" style="margin-top: 24px;" id="add_attribute_value"><i class="fas fa-plus"></i></div>
                                                </div>
                                                <span id="attribute_messege" style="color: red;"></span>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr class="attribute_list_header">
                                                            <th class="attribute_list_items">Giá trị</th>
                                                            <th class="attribute_list_items text-center">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="attributeValue_list">
                                                        <!-- <tr class="variantAttribute_item">
                                                            <td class="attribute_value">Ryzen 5</td>
                                                            <td class="attribute_delete text-center"><i class="fa-solid fa-trash attributeValue_del_btn"></i></td>
                                                        </tr>
                                                        <tr class="variantAttribute_item">
                                                            <td class="attribute_value">Intel i9</td>
                                                            <td class="attribute_delete text-center"><i class="fa-solid fa-trash attributeValue_del_btn"></i></td>
                                                        </tr>
                                                        <tr class="variantAttribute_item">
                                                            <td class="attribute_value">Ryzen 7</td>
                                                            <td class="attribute_delete text-center"><i class="fa-solid fa-trash attributeValue_del_btn"></i></td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer form-btns">
                                            <button type="submit" class="btn btn-success" id="attribute_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="attribute_cancel_btn">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="attribute_delete_modal" role="dialog">
                        <div class="modal-dialog attribute_modal_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-attribute">Xóa thuộc tính</h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="attribute_delete_id">Mã thuộc tính</label>
                                            <input class="form-input form-control" type="text" id="attribute_delete_id" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="attribute_delete_name">Tên thuộc tính</label>
                                            <input class="form-input form-control" type="text" id="attribute_delete_name" readonly>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success" id="attribute_delete_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="attribute_cancel_btn">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Variant-->
                <div class="tabs variant_tab variant tab_hide">
                    <div class="variant_heading" style="position: relative">
                        <h2>QUẢN LÝ BIẾN THỂ</h2>
                        <hr>
                        <div class="notification_variant"></div>
                    </div>
                    <div class="variant_search row" style="margin-bottom: 10px;">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" id="variant_add_btn">Thêm biến thể</button>
                        </div>
                        <div class="variant_filter col-md-2" style="position: absolute;left: 600px;">
                            <select class="form-control variant_filter_category" style="margin-right: 0;">

                            </select>
                        </div>
                        <div class="variant_searchbar input-group col-md-1" style="position: absolute;right: 16px; width: 400px;">
                            <input type="text" class="form-control" id="variant_search_input" placeholder="Search" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" id="variant_search_btn" type="button"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Biến thể</div>
                        <div class="panel-body table-variant" style="margin: 20px;">
                            <table class="table table-hover variant_body">
                                <thead>
                                    <tr class="variant_list_header">
                                        <th class="variant_list_items">Mã biến thể</th>
                                        <th class="variant_list_items">Tên biến thể</th>
                                        <th class="variant_list_items">Đơn giá</th>
                                        <th class="variant_list_items">Số lượng</th>
                                        <th class="variant_list_items">Mã sản phẩm</th>
                                        <th class="variant_list_items">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="variant_list">
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>A74SF029</td>
                                        <td>10000000</td>
                                        <td>1000</td>
                                        <td>2</td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#variantDetail_modal">Xem chi tiết</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger variant_delete_btn" data-toggle="modal" data-target="#variant_delete_modal">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-success variant_update_btn" data-toggle="modal" data-target="#variant_modal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example" class="text-center">
                        <ul class="pagination" id="product_variant_pagination">
                            <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                        </ul>
                    </nav>

                    <div class="modal fade" id="variant_modal" role="dialog" data-action="add">
                        <div class="modal-dialog variant_modal_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-variant">Thêm biến thể</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="variant_form">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Thông tin biến thể</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="variant_id">Mã biến thể</label>
                                                        <input class="form-input form-control" name="id" type="text" id="variant_id" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="variant_name">Tên biến thể</label>
                                                        <input class="form-input form-control" type="text" name="sku_name" id="variant_name" required>
                                                        <span class="form-messege"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="variant_price">Đơn giá</label>
                                                        <input class="form-input form-control" type="number" name="don_gia" id="variant_price" required>
                                                        <span class="form-messege"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="variant_quantity">Số lượng</label>
                                                        <input class="form-input form-control" type="number" name="so_luong" id="variant_quantity" required>
                                                        <span class="form-messege"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="variant_id_sp">Mã sản phẩm</label>
                                                        <input class="form-input form-control" type="text" name="id_san_pham" id="variant_id_sp" required>
                                                        <span class="form-messege"></span>
                                                    </div>
                                                    <!-- <span class="variant_messege" style="color: red;margin-left: 15px;"></span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">Chi tiết biến thể</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="variantAttribute_name">Thuộc tính</label>
                                                        <select id="variantAttribute_name" class="form-control">
                        
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label for="variantAttribute_value">Giá trị</label>
                                                        <select id="variantAttribute_value" class="form-control">
                                                                                
                                                        </select>
                                                    </div>
                                                    <div class="btn btn-success col-md-2" style="margin-top: 24px;" id="addAttribute"><i class="fas fa-plus"></i></div>
                                                </div>
                                                <span class="variantDetail_messege" style="color: red;"></span>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr class="variant_list_header">
                                                            <th class="variant_list_items">Thuộc tính</th>
                                                            <th class="variant_list_items">Giá trị</th>
                                                            <th class="variant_list_items">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="variantAttributeDetail_list">
                                                       
                                                    </tbody>
                                                </table>
                                                <span class="variantAttribute_messege" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer form-btns">
                                            <button type="submit" class="btn btn-success" id="variant_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="variant_cancel_btn">Hủy</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="variant_delete_modal" role="dialog ">
                        <div class="modal-dialog variant_delete_modal_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-variantDelete">Xóa biến thể</h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="variant_delete_id">Mã biến thể</label>
                                            <input class="form-input form-control" type="text" id="variant_delete_id" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="variant_delete_name">Tên biến thể</label>
                                            <input class="form-input form-control" type="text" id="variant_delete_name" readonly>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success" id="variant_delete_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="variant_delete_cancel_btn">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permission -->
                <div class="tabs permission_tab permission tab_hide">
                    <div class="permission_heading" style="position: relative">
                        <h2>QUẢN LÝ NHÓM QUYỀN</h2>
                        <hr>
                        <div class="notification_permission"></div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <button type="button" class="btn btn-success" id="permission_add_btn">Thêm nhóm quyền</button>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Nhóm quyền</div>
                        <div class="panel-body table-permission" style="margin: 20px;">
                            <table class="table table-hover permission_body">
                                <thead>
                                    <tr class="permission_list_header">
                                        <th class="permission_list_items">Mã nhóm quyền</th>
                                        <th class="permission_list_items">Tên nhóm quyền</th>
                                        <th class="permission_list_items">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="permission_list">
                                    <!-- dữ liệu cứng -->
                                    <!-- <tr class="permission_list_content">
                                        <td class="permission_list_item">1</td>
                                        <td class="permission_list_item">admin</td>
                                        <td class="permission_list_item">
                                            <button type="button" class="btn btn-danger permission_delete_btn" data-toggle="modal" data-target="#permission_delete_modal">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-success permission_update_btn" data-toggle="modal" data-target="#permission_modal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                    </tr> -->
                                    <!-- dữ liệu cứng -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="permission_modal" role="dialog" data-action="add">
                        <div class="modal-dialog permission_modal_form">
                            <div class="modal-content" style="width: 1000px;left: 50%;transform: translateX(-50%);">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-permission">Thêm nhóm quyền</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="permission_form">
                                        <div class="form-group">
                                            <label for="permission_id">Mã nhóm quyền</label>
                                            <input class="form-input form-control" type="text" name="id_nhom_quyen" id="permission_id" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="permission_name">Tên nhóm quyền</label>
                                            <input class="form-input form-control" type="text" name="ten_nhom_quyen" id="permission_name" required>
                                        </div>
                                        <span class="permisson-message" style="color: red; margin-left: 10px;"></span>
                                        <table class="table table-hover">
                                            <thead>
                                                <th></th>
                                                <th>Thêm</th>
                                                <th>Sửa</th>
                                                <th>Xóa</th>
                                                <th>Xem</th>
                                            </thead>
                                            <tbody id="permission_feature_detail">
                                                
                                            </tbody>
                                        </table>
                                        <div class="modal-footer form-btns">
                                            <button type="submit" class="btn btn-success" id="permission_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="permission_cancel_btn">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="permission_delete_modal" role="dialog ">
                        <div class="modal-dialog permission_delete_modal_form ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-permissionDelete">Xóa nhóm quyền</h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="permission_delete_id">Mã nhóm quyền</label>
                                            <input class="form-input form-control" type="text " id="permission_delete_id" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="permission_delete_name">Tên nhóm quyền</label>
                                            <input class="form-input form-control" type="text" id="permission_delete_name" readonly>
                                        </div>
                                        <div class="modal-footer form-btns ">
                                            <button type="button" class="btn btn-success" id="permission_delete_confirm_btn">Xác nhận</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="permission_delete_cancel_btn">Hủy</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade permissionDetail_modal permissionDetail_modal_hide" id="permissionDetail_modal" role="dialog">
                        <div class="modal-dialog permissionDetail_modal_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title modal-title-permissionDetail">Chi tiết nhóm quyền</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <th></th>
                                            <th>Thêm</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                            <th>Xem</th>
                                        </thead>
                                        <tbody>
                                            <!-- dữ liệu cứng -->
                                            <tr>
                                                <td>Tài khoản</td>
                                                <td><input type="checkbox" checked disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" checked disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Sản phẩm</td>
                                                <td><input type="checkbox" checked disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" checked disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Danh mục</td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" checked disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Thuộc tính</td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" checked disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Đơn hàng</td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" checked disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" checked disabled></td>
                                            </tr>
                                            <!-- dữ liệu cứng -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="admin_page.js"></script>
        <script src="../components/toastNofication/toast.js"></script>
</body>

</html>

</html>