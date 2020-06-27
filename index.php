<?php 
    define('CSS_PATH', 'templates/CSS/');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask me Now</title>

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>main.css">

</head>
<body>
    
    <?php
        if (isset($_GET['login'])){
            if ($_GET['login'] == 'fail') { ?> 
                <script> alert("There was an error in login. Please, Checkout password or create new account if you dont have an account.");</script>
                <?php   include_once('templates/login.html');
            }
        } else { 
            include_once('templates/login.html');
        }  
    ?>
    

    <script>
        window.history.forward();
        
        var loginRedirectButton = document.getElementById('login-redirect-btn');
        var SignupRedirectButton = document.getElementById('signup-redirect-btn');

        var container = document.getElementById('container');

        loginRedirectButton.addEventListener('click', ()=>{
            container.classList.remove('signup-form-active');
        });

        SignupRedirectButton.addEventListener('click', ()=>{
            container.classList.add('signup-form-active');
        });

        <?php if (isset($_GET['hasAccount'])){ ?>
            alert('You dont have an account. Please Sign up and create an account first.')
            container.classList.add('signup-form-active');
        <?php } ?>


        <?php
            if (isset($_GET['signuperror'])){
                if ($_GET['signuperror'] == 'exists') { ?> 
                    alert("A user already exists with that username. Please choose a different username or try logging in.");
                    <?php
                }
            }  
        ?>

    </script>
</body>
</html>