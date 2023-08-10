<?php
    date_default_timezone_set('Europe/Bratislava');


    class studentLogger
    {
        private function lateVerification()
        {
            return date("H") >= 8;
        }

        public function studentLog($name)
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
            
            $late = $this->lateVerification();
            
            
            if ($late == true){
                $timeLogs[] = date("Y.m.d H:i:s") . " " . $name . " meskanie";
                
            }
            else{
                $timeLogs[] = date("Y.m.d H:i:s") . " " . $name;

            }
        
            file_put_contents("prichody.json", json_encode($timeLogs, JSON_PRETTY_PRINT));

        }
    }

    if (isset($_GET["submit"])){

        $name = $_GET["name"];

        $obj = new studentLogger;

        $obj->studentLog($name);
        $obj->timeLog($name);

        $logins = json_decode(file_get_contents("studenti.json"), true);

        print_r(json_decode(file_get_contents("studenti.json"), true));
        echo "<br>";
        print_r(json_decode(file_get_contents("prichody.json"), true));
    
        echo "<br>" . "Name: " . $name . " logins:" . $logins[$name] . "<br>";
    }



?>

<form method="GET">
    <label> Name: <input type="text" name="name" value=""></label>
    <input type="submit" name="submit" value="Submit">
</form>
