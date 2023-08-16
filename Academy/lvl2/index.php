
<form method="POST">
    <label> Name: <input type="text" name="name" value=""></label>
    <input type="submit" name="submit" value="Submit">
</form>


<?php
    date_default_timezone_set('Europe/Bratislava');


    class studentLogger
    {
        public function lateVerification()
        {
            $decodedPrichody = json_decode(file_get_contents("prichody.json"), true);
            foreach ($decodedPrichody as $decodedPrichod)
            {
                $hours = strtok($decodedPrichod, ":");
                if ($hours <= 8){
                    print_r($decodedPrichod . " meskanie");
                    print_r("<br>");
                }
                else{
                    print_r($decodedPrichod);
                    print_r("<br>");
                }
            }
        }

        public static function studentLog($name)
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
        public function timeLog($name)
        {
            $timeLogs = [];

            if (file_exists("prichody.json")){
                $timeLogs = json_decode(file_get_contents("prichody.json"), true);
            }
                        
            $timeLogs[] = date("H:i:s Y.m.d") . " " . $name;

        
            file_put_contents("prichody.json", json_encode($timeLogs, JSON_PRETTY_PRINT));

        }
    }

    if (isset($_REQUEST)){

        $name = $_REQUEST["name"];

        $obj = new studentLogger;

        studentLogger::studentLog($name);
        $obj->timeLog($name);

        $logins = json_decode(file_get_contents("studenti.json"), true);

        print_r($logins);
        echo "<br>";
        // print_r(json_decode(file_get_contents("prichody.json"), true));
        $obj->lateVerification();
    
        echo "<br>" . "Name: " . $name . " logins:" . $logins[$name] . "<br>";
    }



?>

