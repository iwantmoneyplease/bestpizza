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
        include("../conn.php");

        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $_POST["email"]);
        $stmt->execute();
        $result = $stmt->get_result();

        $userdatafromdb = $result->fetch_assoc();
        if(password_verify($_POST['password'], $userdatafromdb["password"])) {
            $_SESSION["gio"] = true;
            header("Location: /add.php");
            exit;
        }

        $conn->close();
        }
        ?>
        <form id="form" method="POST">
        <input type="text" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="posttype" value="Log in">
        </form>
    </body>
</html>