<?php
    date_default_timezone_set('Europe/Bratislava');


    class StudentLogger
    {
        public function StudentLogg($name)
        {
            $logins = [];

            if (file_exists("studenti.json")){
                $logins = json_decode(file_get_contents("studenti.json"), true);
            }


            if(isset($logins[$name])){
                $logins[$name]++;
            }
            else{
                $logins[$name] = 1;
            }


            file_put_contents("studenti.json", json_encode($logins, JSON_PRETTY_PRINT));
        }
        public function TimeLogg($name)
        {
            $timeLogs = [];

            if (file_exists("prichody.json")){
                $timeLogs = json_decode(file_get_contents("prichody.json"), true);
            }
        
            
            if (date("H") >= 8){
                file_put_contents("prichody.json", json_encode($timeLogs . " <br> " . date("Y.m.d H:i:s") . " " . $name . " meskanie", JSON_PRETTY_PRINT));
        
            }
            else{
                file_put_contents("prichody.json", json_encode($timeLogs . " <br> " . date("Y.m.d H:i:s") . " " . $name, JSON_PRETTY_PRINT));
            }
        }
    }

    if (isset($_GET["submit"])){

        $name = $_GET["name"];

        $obj = new StudentLogger;

        $loginCount = $obj -> StudentLogg($name);
        $obj -> TimeLogg($name);

        $logins = json_decode(file_get_contents("studenti.json"), true);

        print_r(json_decode(file_get_contents("studenti.json"), true));
        echo "<br>";
        print_r(json_decode(file_get_contents("prichody.json"), true));
    
        echo "<br>" . "Name: " . $name . " logins:" . $logins[$name] . "<br>";
    }



?>

<form method="GET">
    <p> Name: <input type="text" name="name", value=""></p>
    <input type="submit" name="submit" value="Submit">
</form>
