<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
session_start();
function find_file($string) {
        $i = 0;
        do  {
            if($i == 1) {
                $string = './' . $string;
            } else if($i == 2) {
                $string = './.' . $string;
                $i = 0;
            }
            $i++;
        } while(!file_exists($string));
        
        return $string;
    }

    // require_once(find_file('models/Database.php'));