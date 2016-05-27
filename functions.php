<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 27-5-2016
 * Time: 17:24
*/

    /**
    * @param $sql_result
    */
    function getAmountOfHouses($sql_result) {
        if(mysqli_num_rows($sql_result) > 1){
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden";
        }
        else{
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden";
        }
    
        echo $amount;
    }