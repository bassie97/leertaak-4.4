<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 27-5-2016
 * Time: 17:24
 */

require_once("db_connection.php");

/**
 * @param $sql
 * @param $filtered
 * @param $conn
 * @return string
 * @internal param $conn
 */
function getAmountOfHouses($sql, $filtered, $conn)
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

function getWoning($woid, $conn){
    $sql = "SELECT 
                woid,
                wo.Address, 
                Vraagprijs,
                wo.PC, 
                wo.City,
                wo.omschrijving
              FROM wo
              WHERE woid = '$woid'";
    $sql_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_result) > 0) {
        return $sql_result;
    }
}

function getAllFromWoning($woid, $conn){
    $sql = "SELECT
              wo.address,
              wo.pc,
              wo.city,
              vraagprijs,
              bouwjaar,
              tuinaanwezig,
              tuinoppervlakte,
              woonoppervlakte,
              inhoud,
              aantalkamers,
              aantalbadkamers,
              aantalwoonlagen,
              perceeloppervlakte,
              plaatsingdatum,
              ligging.name as ligging1,
              a.name as ligging2,
              b.name as ligging3,
              c.name as ligging4,
              d.name as ligging5,
              e.name as ligging6,
              f.name as ligging7,
              g.name as ligging8,
              mkantoor.name as mkantoor,
              status.name as status,
              soortvraagprijs.name as soortvraagprijs,
              soortobject.name as soortobject,
              soortwoning.name as soortwoning,
              typewoning.name as typewoning,
              soortbouw.name as soortbouw
              FROM wo
              LEFT JOIN mkantoor ON wo.mkid = mkantoor.mkid
              LEFT JOIN status ON wo.status = status.id
              LEFT JOIN soortvraagprijs ON wo.vraagprijssoort = soortvraagprijs.id
              LEFT JOIN soortobject ON wo.soortobject = soortobject.id
              LEFT JOIN soortwoning ON wo.soortwoning = soortwoning.id
              LEFT JOIN typewoning ON wo.typewoning = typewoning.id
              LEFT JOIN soortbouw ON wo.soortbouw = soortbouw.id
              LEFT JOIN ligging ON wo.Ligging1 = ligging.id
              LEFT JOIN ligging a ON wo.Ligging2 = a.id
              LEFT JOIN ligging b ON wo.Ligging3 = b.id
              LEFT JOIN ligging c ON wo.Ligging4 = c.id
              LEFT JOIN ligging d ON wo.Ligging5 = d.id
              LEFT JOIN ligging e ON wo.Ligging6 = e.id
              LEFT JOIN ligging f ON wo.Ligging7 = f.id
              LEFT JOIN ligging g ON wo.Ligging8 = g.id
              WHERE woid = '$woid'";
    $sql_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_result) > 0) {
        return $sql_result;
    }
}





