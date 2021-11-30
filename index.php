<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Manao Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if(isset($_COOKIE['user']) && $_COOKIE['user'] === $_SESSION['user']){
    echo '<div  class="welcome"><h1>Hello, '.$_SESSION['user'].'</h1>
<button id="logout">Exit</button></div>';
}else{
    echo '<div class="wrapper">
        <div class="buttons">
            <button class="login-btn">LogIn</button>
            <button class="signup-btn">SignUp</button>
        </div>

        <form hidden="true" id="signup" method="POST">
            <h1>Registration</h1>
            <div class="form-group">
                <p>*Name</p>
                <input id="name" name="name" type="text" placeholder="Choose name">
            </div>
            <div class="form-group">
                <p>*Login</p>
                <input id="usr_login" name="login" type="text" placeholder="Choose login">
                <span hidden="true" id="taken_login" class="taken">This login is already taken!</span>
            </div>
            <div class="form-group">
                <p>*Email</p>
                <input id="email" name="email" type="email" placeholder="Your email">
                <span hidden="true" id="taken_email" class="taken">This email is already taken!</span>
            </div>
            <div class="form-group">
                <p>*Password</p>
                <input id="password" name="pass" type="password" placeholder="Choose password">
            </div>
            <div class="form-group">
                <p>*Confirm password</p>
                <input id="conf_pass" name="conf_pass" type="password" placeholder="Confirm the password">
            </div>
            <input class="form-btn" type="submit" value="SignUp">
        </form>

        <form hidden="true" id="login" method="POST">
            <h1>Authorization</h1>
            <div class="form-group">
                <p>*Login</p>
                <input id="login_login" name="login_login" type="text" placeholder="Your login" required>
                <span hidden="true" id="wrong_login" class="wrong">Wrong login!</span>
            </div>
            <div class="form-group">
                <p>*Password</p>
                <input id="login_pass" name="login_pass" type="password" placeholder="Your password" required>
                <span hidden="true" id="wrong_pass" class="wrong">Wrong password!</span>
            </div>
            <input id="login-form-btn" class="form-btn" type="submit" value="LogIn">
        </form>
        <script src="js/script.js"></script>
    </div>';
}
?>


    <script src="js/signup.js"></script>
    <script src="js/login.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
