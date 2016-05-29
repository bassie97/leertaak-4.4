<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 27-5-2016
 * Time: 17:24
 */

/**
 * @param $sql
 * @param $conn
 */
function getAmountOfHouses($sql, $conn, $filtered)
{
    $sql_result = mysqli_query($conn, $sql);
    if (!$filtered){
        if (mysqli_num_rows($sql_result) > 1) {
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden";
        } else {
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden";
        }
    }else{
        if (mysqli_num_rows($sql_result) > 1) {
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden voor uw filters";
        } else {
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden voor uw filters";
        }
    }

    return $amount;
}

/**
 * @param $arr1
 * @param $sql1
 * @return mixed
 */
function createQuery($arr1, $sql1)
{
    if (count($arr1) > 1) {
        $val = end($arr1);
        $key = key($arr1);
        array_pop($arr1);
        $sql1 .= " WHERE " . $key . " LIKE " . "'%" . $val . "%' ";

        foreach ($arr1 as $key => $val) {
            $sql1 .= "AND " . $key . " LIKE " . "'%" . $val . "%' ";
        }
    } else {
        $val = end($arr1);
        $key = key($arr1);
        array_pop($arr1);
        $sql1 .= " WHERE " . $key . " LIKE " . "'%" . $val . "%' ";
    }
//        $sql1 .= ";";
    $sql = $sql1;
    return $sql;
}

function getMakelaar($mkid, $conn)
{
    $sql = "SELECT name
                From mkantoor
                WHERE mkid='$mkid'";
    $sql_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_result) > 0) {
        while ($row = mysqli_fetch_assoc($sql_result)) {
            echo $row['name'];
        }
    }

}
