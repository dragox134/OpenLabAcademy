<?php

    date_default_timezone_set('Europe/Bratislava');

    function greetings()
    {
        $meskanie = false;
        $currentTime = date("Y/m/d H:i:s");
    
        echo "Ahoj";
        echo "<br>";
        echo $currentTime;
        echo "<br>";
        

        if (date("H") < 24 && date("H") > 20)
        {
            die ("Prichod sa nepodarilo zapisat");
        }
        elseif (date("H") >= 8)
        {
            $meskanie = true;
        }

        writeLog($meskanie, $currentTime);
    }


    function writeLog($meskanie, $currentTime)
    {
        if ($meskanie == true)
        {
            file_put_contents("log.txt", $currentTime . "   meskanie" . " <br>", FILE_APPEND);
        }
        else
        {
            file_put_contents("log.txt", $currentTime . " <br>", FILE_APPEND);
        }
    }

    function getLog()
    {
        echo("<br>");
        echo file_get_contents("log.txt");
    }


    greetings();
    getLog();



    
    