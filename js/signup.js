const headers = {'Content-type': 'application/json'};
$('#signup').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 2,
                    lettersonly: true
                },
                login: {
                    required: true,
                    minlength: 6,
                    alphanumeric2: true

                },
                email: {
                    required: true,
                    email: true
                },
                pass: {
                    required: true,
                    minlength: 6,
                    alphanumeric: true

                },
                conf_pass: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: "Please enter the name",
                    minlength: "Name must be at least 2 characters long",
                    maxlength: "Name must be only 2 characters long"
                },
                login: {
                    required: "Please enter the login",
                    minlength: "Login must be at least 6 characters long"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter the valid email"
                },
                pass: {
                    required: "Please enter the password",
                    minlength: "Password must be at least 6 characters long"

                },
                conf_pass: {
                    required: "Please confirm the password",
                    equalTo: "Passwords are not the same"
                }
            },
            submitHandler: function(form) {
                const body = {
                    "name": $("#name").val(),
                    "usr_login": $("#usr_login").val(),
                    "email": $("#email").val(),
                    "password": $("#password").val()
                }
                fetch('../core/fetch.php', {
                    method: 'POST',
                    body: JSON.stringify(body),
                    headers: headers
                }).then((response) => {
                    response.json().then((result) => {

                        if(result.hasError !== true){
                            document.cookie = "user="+result.login;
                            location.reload();
                        }else {
                            switch (result.reason){
                                case 'user.login.already.exist':
                                    $('#taken_email').prop('hidden', true);
                                    $('#taken_login').prop('hidden', false);
                                    break

                                case 'user.email.already.exist':
                                    $('#taken_login').prop('hidden', true);
                                    $('#taken_email').prop('hidden', false);
                                    break
                            }
                        }
                    });
                });
            }
});
        jQuery.validator.addMethod( "alphanumeric", function( value, element ) {
            return this.optional( element ) || /^(?=.*?\d)(?=.*?[a-zA-Z])[a-zA-Z\d]+$/i.test( value );
        }, "Must be letters and digits" );

        jQuery.validator.addMethod("alphanumeric2", function(value, element) {
            return this.optional(element) || /^\w+$/i.test(value);
        }, "Letters, numbers, and _ only please");

        jQuery.validator.addMethod( "lettersonly", function( value, element ) {
            return this.optional( element ) || /^[a-zA-Z]+$/i.test( value );
        }, "Letters only please" );

