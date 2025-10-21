<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    if($_POST){
    require'../install-functionality.php';
    }
?>

    <form action="" method="POST">
        <input type="text" name="host" placeholder="Host"><br />
        <input type="text" name="database" placeholder="Database"><br />
        <input type="text" name="user" placeholder="User"><br />
        <input type="text" name="password" placeholder="Password"><br />
        <input type="text" name="email" placeholder="login"><br />
        <input type="password" name="loginpass" placeholder="login password"><br />
        <input type="submit" name="posttype" value="Finish setup"><br />
    </form>

</body>
</html>

