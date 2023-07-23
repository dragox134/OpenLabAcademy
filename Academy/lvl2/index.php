<?php
    if (isset($_GET["submit"])){
        file_put_contents("log.json", $_GET["name"] . "<br>\n", FILE_APPEND);
        echo "Name: " . $_GET["name"] . "<br>";
    }
?>

<form method="GET">
    <p> Name: <input type="text" name="name", value=""></p>
    <input type="submit" name="submit" value="Submit">
</form>
