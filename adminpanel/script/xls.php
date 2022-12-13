<?php
    require_once('../../db/dbConnect.php');
    function cleanData(&$str) {
        if ($str == 't') $str = 'TRUE';
        if ($str == 'f') $str = 'FALSE';
        if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) $str = "'$str";
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    if (!empty($_GET['operation'])) {
        if ($_GET['operation'] == 'export-admin') {
            $filename = "admin_data".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM admin"; 
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-center') {
            $filename = "center_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM center";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-city') {
            $filename = "city_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM city";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-court') {
            $filename = "court_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM court";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-customer') {
            $filename = "customer_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM customer";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-city') {
            $filename = "city_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM `city`";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-court') {
            $filename = "city_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM `court`";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-customer') {
            $filename = "city_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM `customer`";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        } else if ($_GET['operation'] == 'export-order') {
            $filename = "order_data_".date('Ymd').".csv";

            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: text/csv");
            $out = fopen($filename, 'w+');

            $flag = false;
            $sql = "SELECT * FROM `torder`";
            $res = $conn -> query($sql);
            while ($data = mysqli_fetch_assoc($res)) {
                if (!$flag) {
                    fputcsv($out, array_keys($data), ',', '"');
                    $flag = true;
                }
                array_walk($data, __NAMESPACE__.'\cleanData');
                fputcsv($out, array_values($data), ',', '"');
            }
            fclose($out);
            exit;
        }
    }
?>