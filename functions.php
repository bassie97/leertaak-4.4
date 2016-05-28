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

    /**
     * @param $arr1
     * @param $sql1
     * @return mixed
     */
    function createQuery($arr1, $sql1){
        if(count($arr1) > 1){
            $val = end($arr1);
            $key = key($arr1);
            array_pop($arr1);
            $sql1 .= " WHERE " . $key . " LIKE " . "'%" . $val . "%' ";

            foreach ($arr1 as $key => $val){
                $sql1 .= "AND " . $key . " LIKE " . "'%" . $val . "%' ";
            }
        }else{
            $val = end($arr1);
            $key = key($arr1);
            array_pop($arr1);
            $sql1.= " WHERE " . $key . " LIKE " . "'%" . $val . "%' ";
        }
        $sql1 .= ";";
        $sql = $sql1;
        return $sql;
    }