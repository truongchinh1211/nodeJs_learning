document.addEventListener("DOMContentLoaded", function() {

    const user = JSON.parse(localStorage.getItem("user"));
    const jwtToken = localStorage.getItem("jwtToken");

    if (user && jwtToken) {
        console.log(user)
        return;
    } else {
        alert("please login before vô web này")
        window.location.replace("../auth/login.php");
    }
});

function renderInfo(user) {
    console.log(user.email)
    $("#email").val(user.email);
    $("#fullName").val(user.fullName);
    $("#userName").val(user.userName);
}



$("#logout-btn").click(function (e) { 
    e.preventDefault();
    localStorage.removeItem('jwtToken');
    localStorage.removeItem('user');
    window.location.href = '../auth/login.php'
});
$('#info-btn').click(function (e) { 
    e.preventDefault();
    const token = localStorage.getItem('jwtToken');
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}` 
      };
    fetch('http://localhost:3000/auth/user-info', {
                method: 'GET',
                headers: headers,
            }).then(response => {
                if(!response.ok)
                    return response.json().then(data =>{throw new Error(data)})
                  return response.json()
        })
            .then(data => {
                if(data.error)
                    throw new Error(data.error)
                console.log(data)
                renderInfo(data)
                $('#order_modal').modal('show')
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
});
$("#submit-btn").click(function (e) { 
    e.preventDefault();
    $('#order_modal').modal('show')
    const token = localStorage.getItem('jwtToken');
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}` 
      };
    const formData = new FormData(document.getElementById('info-form'));
    const data = {};
    for (const [key, value] of formData.entries()) {
        data[key] = value;
    }
    fetch('http://localhost:3000/auth/user-info', {
                method: 'POST',
                headers: headers,
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
});