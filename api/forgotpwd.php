<?php 
    include_once('../models/initialize.php');

    $user = new User();
    $user->username = isset($_POST['username']) ? $_POST['username'] : die();

    $result = $user->getUser();

    $num = $result->rowCount();

    if ($num > 0){
        $row = $result->fetch();
        if ($row['pwd'] == $_POST['password']){
            header("Location: ../index.php?changepwd=oldpwd");
        } else {
            $user->password = $_POST['password'];
            if ($user->changePassword()){
                header("Location: ../index.php?changepwd=success");
            } else {
                header("Location: ../index.php?changepwd=fail");
            }
        }
    } else {
        header("Location: ../index.php?changepwd=noacc");
    }

?>