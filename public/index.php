<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>hej</h1>
        <?php echo '<a href="add.php">CMS Page</a> <br />'; ?>
    <?php
    include("../conn.php");
    $sql = "SELECT content  FROM info WHERE type = 'Image'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ ?>
            <img src="<?php echo $row["content"]; ?>">

        <?php
        }
    }
    $sql = "SELECT name, type, cost  FROM meny";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ ?>
            <h3><?php echo $row["name"]; ?></h3>
            <p>
                <?php echo $row["type"]; ?>
                <span>
                    <?php echo $row["cost"]; ?>
                </span>
            </p>

        <?php
        }
    }
    ?>
</body>
</html>