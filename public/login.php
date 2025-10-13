<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>


        <?php>
        $sql = "SELECT * FROM info WHERE type != 'Image'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
        ?>
            <form action="" method="POST">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="submit" name="posttype" value="Log in">
            </form>
        <?php
        }
        ?>
    }
    </body>
</html>