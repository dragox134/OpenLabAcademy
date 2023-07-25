<?php
    if (isset($_GET["submit"])){
        $name = $_GET["name"];
        $logins = [];
    }

    if (file_exists("log.json")){
        $logins = json_decode(file_get_contents("log.json"), true);
    }

    if(isset($logins[$name])){
        $logins[$name]++;
    }
    else{
        $logins[$name] = 1;
    }

    file_put_contents("log.json", json_encode($logins, JSON_PRETTY_PRINT));


    echo "Name: " . $name . " logins:" . $logins[$name] . "<br>";
?>

<form method="GET">
    <p> Name: <input type="text" name="name", value=""></p>
    <input type="submit" name="submit" value="Submit">
</form>
