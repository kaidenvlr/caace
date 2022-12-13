<?php
    require_once('../../db/dbConnect.php');

    if (!empty($_GET['deleteId']) && !empty($_GET['deleteData'])) {
        if ($_GET['deleteData'] == 'delete-court') {
            
            $sqlcourt = "DELETE FROM `court` WHERE kid=".$_GET['deleteId'];
            $stmtcourt = mysqli_prepare($conn, $sqlcourt);
            $stmtcourt -> execute();

            $sqlorder = "DELETE FROM `torder` WHERE kid=".$_GET['deleteId'];
            $stmtorder = mysqli_prepare($conn, $sqlorder);
            $stmtorder -> execute();

        } else if ($_GET['deleteData'] == 'delete-center') {
            $sqlcenter = "DELETE FROM `center` WHERE ctid=".$_GET['deleteId'];
            
            $stmtcenter = mysqli_prepare($conn, $sqlcenter);
            $stmtcenter -> execute();

            $sqlcourtorder = "select kid from `court` where ctid =".$_GET['deleteId'];
            $resCourtOrder = $conn -> query($sqlcourtorder);
            if ($resCourtOrder -> num_rows > 0) {
                while ($dataCourtOrder = mysqli_fetch_assoc($resCourtOrder)) {
                    $sqlorder = "DELETE FROM `torder` WHERE kid=".$dataCourtOrder['kid'];
                    $stmtorder = mysqli_prepare($conn, $sqlorder);
                    $stmtorder -> execute();
                }
            }

            $sqlcourt = "DELETE FROM `court` WHERE ctid=".$_GET['deleteId'];
            $stmtcourt = mysqli_prepare($conn, $sqlcourt);
            $stmtcourt -> execute();

        } else if ($_GET['deleteData'] == 'delete-admin') {

            $sqladmin = "DELETE FROM `admin` WHERE aid=".$_GET['deleteId'];
            $stmtadmin = mysqli_prepare($conn, $sqladmin);
            $stmtadmin -> execute();

        } else if ($_GET['deleteData'] == 'delete-user') {

            $sqluser = "DELETE FROM `user` WHERE uid=".$_GET['deleteId'];
            $stmtuser = mysqli_prepare($conn, $sqluser);
            $stmtuser -> execute();

            $sqluser = "DELETE FROM `torder` WHERE uid=".$_GET['deleteId'];
            $stmtuser = mysqli_prepare($conn, $sqluser);
            $stmtuser -> execute();

        } else if ($_GET['deleteData'] == 'delete-city') {

            $sqlcity = "DELETE FROM `city` WHERE cid=".$_GET['deleteId'];
            $stmtcity = mysqli_prepare($conn, $sqlcity);
            $stmtcity -> execute();

            $sqlcenterorder = "select ctid from `center` where cid =".$_GET['deleteId'];
            $resCenterOrder = $conn -> query($sqlcenterorder);
            if ($resCenterOrder -> num_rows > 0) {

                while ($dataCenterOrder = mysqli_fetch_assoc($resCenterOrder)) {

                    $sqlcourtorder = "select kid from `court` where ctid =".$dataCenterOrder['ctid'];
                    $resCourtOrder = $conn -> query($sqlcourtorder);

                    if ($resCourtOrder -> num_rows > 0) {
                        while ($dataCourtOrder = mysqli_fetch_assoc($resCourtOrder)) {
                            $sqlorder = "DELETE FROM `torder` WHERE kid=".$dataCourtOrder['kid'];
                            $stmtorder = mysqli_prepare($conn, $sqlorder);
                            $stmtorder -> execute();
                        }
                    }
                }
            }

            $sqlcenter = "DELETE FROM `center` WHERE cid=".$_GET['deleteId'];
            $stmtcenter = mysqli_prepare($conn, $sqlcenter);
            $stmtcenter -> execute();

            $sqlcenter = "DELETE FROM `court` WHERE cid=".$_GET['deleteId'];
            $stmtcenter = mysqli_prepare($conn, $sqlcenter);
            $stmtcenter -> execute();

        } else if ($_GET['deleteData'] == 'delete-order') {

            $sqlorder = "DELETE FROM `order` WHERE oid=".$_GET['deleteId'];
            $stmtorder = mysqli_prepare($conn, $sqlorder);
            $stmtorder -> execute();

        } else if ($_GET['deleteData'] == 'delete-tariff') {

            $sqltariff = "DELETE FROM `timeslotcenter` where tscid = " . $_GET['deleteId'];
            $stmttariff = mysqli_prepare($conn, $sqltariff);
            $stmttariff -> execute();

            $sqlorder = "DELETE FROM `torder` WHERE tariffid=".$_GET['deleteId'];
            $stmtorder = mysqli_prepare($conn, $sqlorder);
            $stmtorder -> execute();

        }
    }
?>