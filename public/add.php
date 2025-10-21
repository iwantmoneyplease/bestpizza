<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo '<a href="/">Go back</a> <br />'; ?>

    <form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="posttype">
    </form>


    <?php
    if($_POST){ //table functions, publish, destroy, update
        require("../conn.php");

        if($_POST["posttype"] == "publish"){

            $stmt = $conn->prepare("INSERT INTO meny(name,type,cost) VALUES(?,?,?)");
            $stmt->bind_param("sss", $_POST["name"], $_POST["type"], $_POST["cost"]);

            $stmt->execute();
            $stmt->close();
            $conn->close();
        } 

        else if($_POST["posttype"] == "DESTROY"){

            $sql = "DELETE FROM meny WHERE _id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_POST["id"]);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }

        else if($_POST["posttype"] == "update"){

            $sql = "UPDATE meny SET name = ?, type = ?, cost = ? WHERE _id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $_POST["name"], $_POST["type"], $_POST["cost"], $_POST["id"]);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
        else if($_POST["posttype"] == "Upload Image"){
            require("../admin/uploadimg.php");
        }

        else if($_POST["posttype"] == "Ändra Öppetider"){
            $sql = "UPDATE info SET content = ? WHERE _id = 2";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_POST["Öppetider"]);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }

        else if($_POST["posttype"] == "Ändra Kontakt"){
            $sql = "UPDATE info SET content = ? WHERE _id = 3";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_POST["Kontakt"] );
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }
?>

    <?php
    include("../conn.php");

    $sql = "SELECT * FROM info WHERE type != 'Image'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            ?>
            <form action="" method="POST">
                <input type="text" name="<?php echo $row["type"]; ?>" value="<?php echo $row["content"];?>">
                <input type="submit" value="Ändra <?php echo $row["type"]; ?>" name="posttype">
            </form>
        <?php
        }
    }
    $conn->close();
    ?>
    <form id="form" action="/add.php" method="POST">
        <input type="text" name="name" placeholder="name of pizza">
        <input type="text" name="type" placeholder="type of pizza">
        <input type="text" name="cost" placeholder="cost of pizza">
        <input type="submit" name="posttype" value="publish">
    </form>

    <?php
    include("../conn.php");

    $sql = "SELECT _id, name, type, cost FROM meny";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ ?>
            <h3><?php echo $row["_id"]; ?></h3>
            <form action="" method="post">
                <input type="text" name="id" value="<?php echo $row["id"];?>" hidden>
                <input type="text" name="name" value="<?php echo $row["name"]; ?>">
                <input type="text" name="type" value="<?php echo $row["type"]; ?>">
                <input type="text" name="cost" value="<?php echo $row["cost"]; ?>">
                <input type="submit" name="posttype" value="update">
            </form>
            <form action="" method="POST">
                <input type="text" name="id" value="<?php echo $row["_id"];?>" hidden>
                <input type="submit" name="posttype" value="DESTROY">
            </form>
        <?php
        }
    }
    $conn->close();
    ?>

</body>
</html>