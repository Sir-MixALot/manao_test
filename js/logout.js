$('#logout').click(function (){
    document.cookie = "user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    location.reload();
})