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
    if (!$filtered) {
        if (mysqli_num_rows($sql_result) > 1) {
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden";
        } else {
            $amount = mysqli_num_rows($sql_result) . " koopwoningen gevonden";
        }
    } else {
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
    } elseif (count($arr1) != 0) {
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

function getMakelaarForWoid($woid, $conn)
{
    $sql = "SELECT mkantoor.mkid, mkantoor.name, mkantoor.address, mkantoor.pc, mkantoor.city, mkantoor.phone
                From mkantoor
                WHERE mkid = (SELECT mkid
                			 FROM wo
                             WHERE woid = '$woid')";
    $sql_result = mysqli_query($conn, $sql);
    return $sql_result;
}

function getWoning($woid, $conn)
{
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

function getAllFromWoning($woid, $conn)
{
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
              WHERE woid = '$woid'";
    $sql_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_result) > 0) {
        return $sql_result;
    }
}

function getLiggingForWoid($woid, $conn) {
    $sql = "SELECT ligging.Name FROM ligging JOIN wo_ligging ON ligging.ID = wo_ligging.liggingid JOIN wo ON wo_ligging.woid = wo.WOID WHERE wo.WOID = $woid ";

    $sql_result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_result) > 0) {
        return $sql_result;
    }
}

//function createAppointmentList($mkid, $conn)
//{
//    $time = 0;
//    for ($i = 0; $i < 15; $i) {
//        for ($hour = 9; $hour < 17; $hour++) {
//            for ($minutes = 00; $minutes <= 30; $minutes += 30) {
//                if ($minutes == 0) {
//                    $time = $hour . ":" . $minutes . "0<br/>";
//                } else {
//                    $time = $hour . ":" . $minutes, "<br/>";
//                }
//                $sql = "SELECT COUNT(mkid)
//                        FROM afspraak
//                        WHERE mkid = '$mkid'
//                        AND van = '$time' ";
//                $sql_result = mysqli_query($conn, $sql);
//                if (mysqli_num_rows($sql_result) == 0){
//                    ?>
<!--                    <tr>-->
<!--                        -->
<!--                    </tr>-->
<!--                    --><?php
//                }
//            }
//        }
//    }
//}





