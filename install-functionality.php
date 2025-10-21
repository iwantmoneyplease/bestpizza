<?php
$env = [
'DB_HOST' => $_POST["host"],
'DB_PORT' => '3306',
'DB_DATABASE' => $_POST["database"],
'DB_USER' => $_POST["user"],
'DB_PASSWORD' => $_POST["password"],
];

$conn = mysqli_connect($env["DB_HOST"], $env["DB_USER"], $env["DB_PASSWORD"], $env["DB_DATABASE"]);
if(!$conn) {
    die("connection failer:" . mysqli_connect_error());
}else {
    $content = "";
    foreach ($env as $key => $value) {
        $content .= "{$key}={$value}\n";
    }
    $file = __DIR__ . '/.env';
    if (file_put_contents($file, $content)) {
        echo ".env file created successfully at {$file}";
    } else {
        echo "Error creating .env file.";
    }

    $sql = "CREATE TABLE IF NOT EXISTS admin(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(33) NOT NULL,
        password VARCHAR(33) NOT NULL
        ) CHARSET=utf8mb4";
    $createAdmin = $conn->query($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS info(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(50) NOT NULL,
        content VARCHAR(300) NOT NULL
        ) CHARSET=utf8mb4";
    $createInfo = $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS meny(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20) NOT NULL,
        type VARCHAR(20) NOT NULL,
        cost VARCHAR(50) NOT NULL
        ) CHARSET=utf8mb4";
    $createMeny = $conn->query($sql);

    $somearray = [
    ['Image', ''],
    ['Öppetider', ''],
    ['Kontakt', '']
    ];
    foreach ($somearray as $row) {
        $type = $row[0];
        $info = $row[1];
        $conn->query("INSERT INTO info (type, content) VALUES ('$type', '$info')");
    }
    $conn->query("INSERT INTO admin (email, password) VALUES ('{$_POST["email"]}', '{$_POST["loginpass"]}')");
    $conn->query("INSERT INTO meny (name, type, cost) VALUES ('testPie', 'testToppings', 'testPrice')");

} ?>