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
            require("../conn.php");

            if($_POST["posttype"] == "publish"){

                $stmt = $conn->prepare("INSERT INTO admin (email, password) VALUES(?,?)");
                $stmt->bind_param("ss", $_POST["email"], $_POST["password"]);

                $stmt->execute();
                $stmt->close();
                $conn->close();
            } 
        }
        ?>
        
        <form action="" method="POST">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="submit" name="posttype" value="publish">
        </form>

    </body>
</html>