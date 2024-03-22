const line = document.querySelector('.line')
const desc = document.querySelector('.desc')
const activeTab = document.querySelector('.active')
const inputForms = document.querySelectorAll(".form-input")

$(document).ready(function () {
    
    desc.innerHTML = "Chào mừng bạn đến với shop!";
    desc.style.color = "var(--text-color)";
    line.style.height = activeTab.offsetHeight + "px"
    line.style.width = activeTab.offsetWidth + "px"
    line.style.left = (activeTab.offsetLeft + 20) + 'px'
    line.style.top = '20px'   // padding of element

    inputForms.forEach(function(item) {
        item.addEventListener("focus", function() {
            item.classList.add("form-input-active");
        })
        item.addEventListener("blur", function() {
            item.classList.remove("form-input-active");
        })
    })
});

function getParentElement(element, parent) {
    while(element.parentElement) {
        if(element.parentElement.matches(parent)) {
            return element.parentElement;
        }
        element = element.parentElement;
    }
}

// reset error valid trước đó
function resetInValidInputs() {
    inputForms.forEach((item) => {
        item.classList.remove("invalid");
        item.value = ""
        getParentElement(item, ".form-group").querySelector(".form-messege").innerText = "";
    });
}


$("#form-1, #form-2").submit(function (e) { 
    e.preventDefault()
    const check1 = usernameValid()
    const check2 = emailValid()
    const check3 = passwordValid()
    const check4 = confirmPassWordValid()
    const check5 = fullnameValid()
    const checkLogin1 = usernameLoginValid()
    const checkLogin2 = PasswordLoginValid()

    if($("#sign-up").hasClass("active")) {
        const username = $("#username").val();
        if(check5&&check1&&check2&&check3&&check4) {
            e.preventDefault()
            const formData = new FormData(document.getElementById('form-1'));
            const data = {};
            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }
            fetch('http://localhost:3000/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => {
                if(!response.ok)
                    return response.json().then(data =>{throw new Error(data)})
                  return response.json()
        })
            .then(data => {
                if(data.error)
                    throw new Error(data.error)
                toast({
                    title: "Thành công!",
                    message: data.message,
                    type: "success",
                    duration: 4000
                });
                $("#log-in").click();
            })
            .catch(error => {
                console.log(error)
                toast({
                    title: "Thất bại!",
                    message: "Đã có lỗi xảy ra (" + error + ")",
                    type: "error",
                    duration: 4000
                });
            });
        } else
            e.preventDefault()
    } else {
        // login
        if(checkLogin1&&checkLogin2) {
            e.preventDefault()
            const formData = new FormData(document.getElementById('form-2'));
            const data = {};
            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }
            fetch('http://localhost:3000/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => {
                if(!response.ok)
                    return response.json().then(data =>{throw new Error(data)})
                  return response.json()
        })
            .then(data => {
                if(data.error)
                    throw new Error(data.error)
                    localStorage.setItem('jwtToken',data.data.token);
                    localStorage.setItem('user',JSON.stringify(data.data.user));
                toast({
                    title: "Thành công!",
                    message: data.message,
                    type: "success",
                    duration: 4000
                });
                setTimeout(() => {
                    window.location.replace("../demo/index.php");
                }, 2000);
            })
            .catch(error => {
                console.log(error)
                toast({
                    title: "Thất bại!",
                    message: "Đã có lỗi xảy ra (" + error + ")",
                    type: "error",
                    duration: 4000
                });
            });
        } else
            e.preventDefault()
    }
});

function isExistUsername(username){
    return $.ajax({
        type: "GET",
        url: `../../../main/controller/api/accountAPI.php?action=check`,
        data: `username=${username}`,
        async:false,
        dataType: "json",
        success: function (response) {
            toast({
                title: "Thất bại!",
                message: "Tài khoản đã tồn tại",
                type: "error",
                duration: 4000
            });
        }
    }).responseText;
}


$("#sign-up").click(function () { 
    $("#form-1").removeClass("hide_form");
    $("#form-2").addClass("hide_form");
    desc.innerText = 'Chào mừng đến với shop!'
    desc.style.color = "var(--text-color)";
    line.style.width = this.offsetWidth + "px"
    line.style.left = (this.offsetLeft + 20) + 'px'
    line.style.height = activeTab.offsetHeight + "px"
    line.style.top = '20px'
    $(".active").removeClass("active");
    $(this).addClass("active");
    resetInValidInputs()
});


$("#log-in").click(function () { 
    $("#form-1").addClass("hide_form");
    $("#form-2").removeClass("hide_form");
    desc.innerText = 'Mừng bạn quay lại!'
    desc.style.color = "var(--text-color)";
    line.style.width = this.offsetWidth + "px"
    line.style.left = (this.offsetLeft + 20) + 'px'
    line.style.height = activeTab.offsetHeight + "px"
    line.style.top = '20px'
    $(".active").removeClass("active");
    $(this).addClass("active");
    resetInValidInputs()
});

const fullname = document.querySelector("#fullName")
const username = document.querySelector("#username")
const email = document.querySelector("#email")
const password = document.querySelector("#password")
const confirmPass = document.querySelector("#confirm-password")
const username_login = document.querySelector("#username-login")
const username_pass = document.querySelector("#password-login")

username.addEventListener("blur", usernameValid)
email.addEventListener("blur", emailValid)
password.addEventListener("blur", passwordValid)
confirmPass.addEventListener("blur", confirmPassWordValid)

function usernameValid() {
    let value = username.value;
    let messege = value ? true : false;
    const form_group = getParentElement(username, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if (!messege) {
        username.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    }
    else {
        username.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}
function fullnameValid() {
    let value = fullname.value;
    let messege = value ? true : false;
    const form_group = getParentElement(fullname, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if (!messege) {
        fullname.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    }
    else {
        fullname.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}

function usernameLoginValid() {
    let value = username_login.value;
    let messege = value ? true : false;
    const form_group = getParentElement(username_login, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if (!messege) {
        username_login.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    }
    else {
        username_login.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}

function PasswordLoginValid() {
    let value = username_pass.value;
    let messege = value ? true : false;
    const form_group = getParentElement(username_pass, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if (!messege) {
        username_pass.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    }
    else {
        username_pass.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}

function emailValid() {
    let value = email.value;
    let messege1 = value ? true : false;
    const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    let messege2 = regex.test(value);
    const form_group = getParentElement(email, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if(!messege1) {
        email.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    } 
    else if(!messege2) {
        email.classList.add("invalid");
        errorSpan.innerText = "Vui lòng nhập đúng định dạng email";
        return false;
    }
    else {
        email.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}

function passwordValid() {
    let value = password.value;
    let messege1 = value ? true : false;
    let messege2 = value.length<6 ? false : true;
    const form_group = getParentElement(password, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if(!messege1) {
        password.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    } 
    else if(!messege2) {
        password.classList.add("invalid");
        errorSpan.innerText = "Độ dài mật khẩu tối thiểu là 6 ký tự!";
        return false;
    } 
    else {
        password.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}

function confirmPassWordValid() {
    let value = confirmPass.value;
    let messege1 = value ? true : false;
    let messege2 = value === password.value ? true : false;
    const form_group = getParentElement(confirmPass, ".form-group");
    const errorSpan = form_group.querySelector(".form-messege");
    if(!messege1) {
        confirmPass.classList.add("invalid");
        errorSpan.innerText = "Vui lòng không để trống";
        return false;
    } 
    else if(!messege2) {
        confirmPass.classList.add("invalid");
        errorSpan.innerText = "Mật khẩu nhập lại không trùng khớp!";
        return false;
    } 
    else {
        confirmPass.classList.remove("invalid");
        errorSpan.innerText = "";
        return true;
    }
}