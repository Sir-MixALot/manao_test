var login = $('#login');
var signup = $('#signup');
$('.login-btn').click(function (){
    $(this).addClass('focus');
    $('.signup-btn').removeClass('focus');
    $("#signup").trigger("reset");
    if(login.prop('hidden', true)){
        login.prop('hidden', false);

    }
    if(signup.prop('hidden', false)) {
        signup.prop('hidden', true);
        login.prop('hidden', false);
    }

});

$('.signup-btn').click(function (){
    $(this).addClass('focus');
    $('.login-btn').removeClass('focus');
    $("#login").trigger("reset");
    if(signup.prop('hidden', true)){
        signup.prop('hidden', false);

    }
    if(login.prop('hidden', false)) {
        login.prop('hidden', true);
        signup.prop('hidden', false);

    }
});
