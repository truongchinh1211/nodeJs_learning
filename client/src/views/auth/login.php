<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="../components/toastNofication/toast.css">
</head>
<body>

    <?php 
        include '../components/header/header.php';
    ?>
    <!-- toast message -->
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
    <div class="form-contain">
        <div class="form-header">
            <div class="form-title">
                <h3 id="sign-up" class="active">Đăng Ký</h3>
                <h3 id="log-in">Đăng Nhập</h3>
            </div>
            <div class="line"></div>
            <p class="desc"></p>
        </div>

        <form class="form" id="form-1">
        
            <div class="spacer"></div>
            <div class="form-group">
                <label for="fullname" class="form-label">full name <span style="color: red;">*</span></label>
                <input type="text" name="fullName" id="fullName" class="form-input">
                <span class="form-messege"></span>
            </div>

            <div class="form-group">
                <label for="username" class="form-label">User name <span style="color: red;">*</span></label>
                <input type="text" name="userName" id="username" class="form-input">
                <span class="form-messege"></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                <input type="text" name="email" id="email" class="form-input">
                <span class="form-messege"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu <span style="color: red;">*</span></label>
                <input type="password" name="password" id="password" class="form-input">
                <span class="form-messege"></span>
            </div>

            <div class="form-group">
                <label for="confirm-password" class="form-label">Xác nhận mật khẩu <span style="color: red;">*</span></label>
                <input type="password" name="confirm-password" id="confirm-password" class="form-input">
                <span class="form-messege"></span>
            </div>

            <button id="signUp_btn" class="form-btn">Đăng ký</button>
        </form>

        <form class="form hide_form" id="form-2">

            <div class="spacer"></div>

            <div class="form-group">
                <label for="username-login" class="form-label">User name</label>
                <input type="text" name="userName" id="username-login" class="form-input">
                <span class="form-messege"></span>  
            </div>
            
            <div class="form-group">
                <label for="password-login" class="form-label">Mật khẩu</label>
                <input type="password" name="password" id="password-login" class="form-input">
                <span class="form-messege"></span>
            </div>

            <button class="form-btn">Đăng nhập</button>
        </form>
    </div>

    <script src="../components/toastNofication/toast.js"></script>
    <script src="./login.js"></script>
</body>

<footer id="login_footer">
    <?php 
        include '../components/footer/footer.php';
    ?>
</footer>

</html>