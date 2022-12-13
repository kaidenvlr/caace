<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}


$dbname = "p-329408_icourt";

$editId = $_GET['editId'];
if (!empty($editId)) {
    $sqlEditInputs = 'select cid, ctname, ctaddress, ctdescription, ctstatus from `center` where ctid=' . $editId;
    $resEditInputs = $conn->query($sqlEditInputs);
    $dataEditInputs = mysqli_fetch_assoc($resEditInputs);
}
?>

<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin Panel</title>
    <meta name="description" content="Ecommerce Order List Page" />
    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="font/CS-Interface/style.css" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/OverlayScrollbars.min.css" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="css/styles.css" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="css/main.css" />
    <script src="js/base/loader.js"></script>
</head>

<body>
    <div id="root">
        <?php include('./partials/navbar.php') ?>

        <main>
            <div class="container">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-auto mb-3 mb-md-0 me-auto">
                            <div class="w-auto sw-md-70">
                                <a href="./tarifes.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                                    <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                                    <span class="text-small align-middle">Тарифы</span>
                                </a>
                                <h1 class="mb-0 pb-0 display-4" id="title">Новый тариф</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <?php
                if (isset($_POST['save'])) {
                    $sql = "INSERT INTO `timeslotcenter` (ctid, kid, tsstart, tsend, price) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "iiiid", $_POST['ctname'], $_POST['kid'], $_POST['tscstart'], $_POST['tscend'], $_POST['price']);
                    mysqli_stmt_execute($stmt);
                }
                ?>

                <div class="row gx-4 gy-5">
                    <!-- Customer Start -->
                    <div class="col-12 col-xl-10 col-xxl-12">
                        <h2 class="small-title">Информация</h2>
                        <div class="card">
                            <div class="card-body mb-n5">
                                <div class="mb-5">
                                    <div>
                                        <p class="text-small text-muted mb-2">Данные о тарифе</p>
                                        <div class="row g-0 mb-2">
                                            <form method="POST">
                                                <div class="form-group m-2">
                                                    <label for="tscstart" class="mb-1">
                                                        Время начала
                                                    </label>
                                                    <br />
                                                    <select class="form-control" name="tscstart" id="tscstart">
                                                        <?php
                                                        $sqlSelectTimeStart = "select tsid, tsname from `timeslot`";
                                                        $resSelectTimeStart = $conn->query($sqlSelectTimeStart);
                                                        while ($dataSelectTimeStart = mysqli_fetch_assoc($resSelectTimeStart)) {
                                                        ?>
                                                            <option value="<?php echo $dataSelectTimeStart['tsid']; ?>"><?php echo $dataSelectTimeStart['tsname']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="tscend" class="mb-1">
                                                        Время конца
                                                    </label>
                                                    <br />
                                                    <select class="form-control" name="tscend" id="tscend">
                                                        <?php
                                                        $sqlSelectTimeEnd = "select tsid, tsname from `timeslot`";
                                                        $resSelectTimeEnd = $conn->query($sqlSelectTimeEnd);
                                                        while ($dataSelectTimeEnd = mysqli_fetch_assoc($resSelectTimeEnd)) {
                                                        ?>
                                                            <option value="<?php echo $dataSelectTimeEnd['tsid']; ?>"><?php echo $dataSelectTimeEnd['tsname']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="ctname" class="mb-1">
                                                        Центр
                                                    </label>
                                                    <br />
                                                    <select class="form-control" name="ctname" id="ctname">
                                                        <?php
                                                        if ($_SESSION['role'] != 2) {
                                                            $sqlSelectCenter = "select ctname, ctid from `center`";
                                                        ?>
                                                            <option value="" selected disabled hidden>Выберите центр</option>
                                                        <?php }
                                                        else {
                                                            $sqlcenterrole = "select * from `centerrole` where aid=".$_SESSION['id'];
                                                            $rescenterrole = $conn -> query($sqlcenterrole);
                                                            $datacenterrole = mysqli_fetch_assoc($rescenterrole);

                                                            $sqlSelectCenter = "select ctname, ctid from `center` where ctid = " . $datacenterrole['ctid'];
                                                        }
                                                        $resSelectCenter = $conn->query($sqlSelectCenter);
                                                        while ($dataSelectCenter = mysqli_fetch_assoc($resSelectCenter)) {
                                                        ?>
                                                            <option value="<?php echo $dataSelectCenter['ctid']; ?>" <?php if ($_GET['ctid'] == $dataSelectCenter['ctid']) echo "selected"; ?>>
                                                                <?php echo $dataSelectCenter['ctname']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="kname" class="mb-1">
                                                        Корт
                                                    </label>
                                                    <br />
                                                    <select class="form-control" name="kid" id="kname">
                                                        <?php
                                                        $sqlSelectCourt = "select kid, kname from `court` where ctid = " . $_GET['ctid'];
                                                        $resSelectCourt = $conn->query($sqlSelectCourt);
                                                        while ($dataSelectCourt = mysqli_fetch_assoc($resSelectCourt)) {
                                                        ?>
                                                            <option value="<?php echo $dataSelectCourt['kid']; ?>"><?php echo $dataSelectCourt['kname']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="tscprice" class="mb-1">
                                                        Цена
                                                    </label>
                                                    <br />
                                                    <input type="number" name="price" id="tscprice">
                                                </div>
                                                <button type="submit" name="save" class="btn btn-primary m-2">Сохранить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Customer End -->
                    </div>
                </div>
        </main>

        <?php include('./partials/footer.php'); ?>


    <!-- Vendor Scripts Start -->
    <script src="js/vendor/jquery-3.5.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/vendor/OverlayScrollbars.min.js"></script>
    <script src="js/vendor/autoComplete.min.js"></script>
    <script src="js/vendor/clamp.min.js"></script>
    <script src="js/vendor/tagify.min.js"></script>
    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="font/CS-Line/csicons.min.js"></script>
    <script src="js/base/helpers.js"></script>
    <script src="js/base/globals.js"></script>
    <script src="js/base/nav.js"></script>
    <script src="js/base/search.js"></script>
    <script src="js/base/settings.js"></script>
    <script src="js/base/init.js"></script>
    <!-- Template Base Scripts End -->
    <!-- Page Specific Scripts Start -->
    <script src="js/pages/customers.detail.js"></script>
    <script src="js/common.js"></script>
    <script src="js/scripts.js"></script>
    
    <script>
        $(document).on('change', '#ctname', function() {
            var ctid = $('#ctname').val();
            $.ajax({
                type: 'get',
                url: 'addtariff.php',
                data: {
                    'ctid': ctid
                },
                success: function(data){
                    window.history.pushState("object or string", "Title", "addtariff.php".concat("?ctid=").concat(ctid));
                    document.location.reload();
                }
            });
        });
    </script>
    <!-- Page Specific Scripts End -->
</body>

</html>