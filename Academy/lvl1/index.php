<?php

    date_default_timezone_set('Europe/Bratislava');

    function greetings()
    {
        $meskanie = FALSE;
        $currentTime = date("\nY/m/d H:i:s");
        $log = fopen("log.txt", "a");
    
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
            $meskanie = TRUE;
        }

        writeLog($meskanie, $log, $currentTime);
    }


    function writeLog($meskanie, $log, $currentTime)
    {
        if ($meskanie == TRUE)
        {

            fwrite($log, $currentTime . "   meskanie" . "<br>");
        }
        else
        {
            fwrite($log, $currentTime . "<br>");
        }

        fclose($log);

        getLog();

    }

    function getLog()
    {
        $log = fopen("log.txt", "r");

        echo("<br>");
        echo fread($log, filesize("log.txt"));
        
        fclose($log);
    }


    greetings();


    
    