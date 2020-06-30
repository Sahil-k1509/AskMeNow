<?php 
    define('CSS_PATH', 'templates/CSS/');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask me Now</title>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="./jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>main.css">

</head>
<body>
    
    <?php
        if (isset($_GET['login'])){
            if ($_GET['login'] == 'fail') { 
                   include_once('templates/login.html');
            }
        } else { 
            include_once('templates/login.html');
        }  
    ?>
    

    <script>
        window.history.forward();
        
        var loginRedirectButton = document.getElementById('login-redirect-btn');
        var SignupRedirectButton = document.getElementById('signup-redirect-btn');
        var ForgotRedirectButton = document.getElementById('forgot-redirect-btn');
        var ForgotCloseButton = document.getElementById('close-forgotpwd');

        var container = document.getElementById('container');

        loginRedirectButton.addEventListener('click', ()=>{
            container.classList.remove('signup-form-active');
        });

        SignupRedirectButton.addEventListener('click', ()=>{
            container.classList.add('signup-form-active');
        });

        ForgotRedirectButton.addEventListener('click', ()=>{
            container.classList.add('forgot-form-active');
        });

        ForgotCloseButton.addEventListener('click', ()=>{
            container.classList.remove('forgot-form-active');
        });

        <?php if (isset($_GET['hasAccount'])){ ?>
            document.getElementById('login-error-uname').innerHTML = "You don't have an account. Please create an account before logging in.";
            //container.classList.add('signup-form-active');
        <?php } ?>


        <?php
            if (isset($_GET['signuperror'])){
                if ($_GET['signuperror'] == 'exists') { ?> 
                    document.getElementById('signup-error-uname').innerHTML = "A user already exists with that username. Please choose a different username or try logging in.";
                    container.classList.add('signup-form-active');
                    <?php
                }
            }  
        ?>

        <?php
        if (isset($_GET['login'])){
            if ($_GET['login'] == 'fail') { ?>
                   document.getElementById('login-error-pwd').innerHTML = "Password does not match!"; 
            <?php 
            }
        } ?>


        $('#signup-password').keyup(function(){   
                var score = this.value.length;

                if (this.value == ""){
                    $("#signup-form .progress-bar_text").text("Password is blank");
                    $("#signup-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "0%", "background-color": "none" 
                    })
                } else if (score <= 3){
                    $("#signup-form .progress-bar_text").text("Very Weak");
                    $("#signup-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "20%", "background-color": "red" 
                    })
                } else if (score <= 6){
                    $("#signup-form .progress-bar_text").text("Weak");
                    $("#signup-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "40%", "background-color": "orange" 
                    })
                }  else if (score <= 9){
                    $("#signup-form .progress-bar_text").text("Good");
                    $("#signup-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "60%", "background-color": "yellow" 
                    })
                } else if (score <= 12){
                    $("#signup-form .progress-bar_text").text("Strong");
                    $("#signup-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "80%", "background-color": "lightgreen" 
                    })
                }  else if (score >= 12){
                    $("#signup-form .progress-bar_text").text("Very Strong");
                    $("#signup-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "100%", "background-color": "green" 
                    })
                }

            });


            $('#forgotpwd-password').keyup(function(){   
                var score = this.value.length;

                if (this.value == ""){
                    $("#forgotpwd-form .progress-bar_text").text("Password is blank");
                    $("#forgotpwd-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "0%", "background-color": "none" 
                    })
                } else if (score <= 3){
                    $("#forgotpwd-form .progress-bar_text").text("Very Weak");
                    $("#forgotpwd-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "20%", "background-color": "red" 
                    })
                } else if (score <= 6){
                    $("#forgotpwd-form .progress-bar_text").text("Weak");
                    $("#forgotpwd-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "40%", "background-color": "orange" 
                    })
                }  else if (score <= 9){
                    $("#forgotpwd-form .progress-bar_text").text("Good");
                    $("#forgotpwd-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "60%", "background-color": "yellow" 
                    })
                } else if (score <= 12){
                    $("#forgotpwd-form .progress-bar_text").text("Strong");
                    $("#forgotpwd-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "80%", "background-color": "lightgreen" 
                    })
                }  else if (score > 12){
                    $("#forgotpwd-form .progress-bar_text").text("Very Strong");
                    $("#forgotpwd-form .progress-bar_wrap .progress-bar_item").css({
                        "width": "100%", "background-color": "green" 
                    })
                }

            });


    </script>
</body>
</html>