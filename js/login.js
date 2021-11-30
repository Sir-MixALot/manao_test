$('#login').validate({
    rules: {
        login_login: {
            required: true,
            minlength: 6
        },
        login_pass: {
            required: true,
            minlength: 6,
            alphanumeric: true
        },
    },
    messages: {
        login: {
            required: "Please enter your login",
            minlength: "Login must be at least 6 characters long"
        },
        pass: {
            required: "Please enter your password",
            minlength: "Password must be at least 6 characters long"

        }
    },
    submitHandler: function(form) {
        const body = {
            "usr_login": $("#login_login").val(),
            "password": $("#login_pass").val()
        }
        fetch('../core/fetch.php', {
            method: 'POST',
            body: JSON.stringify(body)
        }).then((response) => {
            response.json().then((result) => {
                if(result.hasError !== true){
                    document.cookie = "user="+result.login;
                    location.reload();
                }else {
                    switch (result.reason){
                        case 'user.login.notfound':
                            $('#wrong_pass').prop('hidden', true);
                            $('#wrong_login').prop('hidden', false);
                            break

                        case 'user.password.wrong':
                            $('#wrong_pass').prop('hidden', false);
                            $('#wrong_login').prop('hidden', true);
                            break
                    }
                }
            });
        });
    }
});