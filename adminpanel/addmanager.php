<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}

$editId = $_GET['edit'];
if (!empty($editId)) {
    $sqlEditInputs = 'select username from `admin` where aid=' . $editId;
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
                                <a href="./manager.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                                    <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                                    <span class="text-small align-middle">Менеджеры</span>
                                </a>
                                <h1 class="mb-0 pb-0 display-4" id="title"><?php echo empty($_GET['edit']) ? 'Новый менеджер центра' : 'Редактирование менеджера центра №' . $_GET['edit']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <?php
                if (isset($_POST['save'])) {
                    if (empty($_GET['edit'])) {
                        $sql = "INSERT INTO `admin` (username, password, arole) VALUES (?, ?, 2)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], md5($_POST['password']));
                        mysqli_stmt_execute($stmt);

                        $sqlNumManager = "select max(aid) c from `admin`";
                        $resNumManager = $conn -> query($sqlNumManager);
                        $dataNumManager = mysqli_fetch_assoc($resNumManager);

                        $sqlManager = "INSERT INTO `centerrole` (aid, ctid) VALUES (?, ?)";
                        $stmtManager = mysqli_prepare($conn, $sqlManager);
                        mysqli_stmt_bind_param($stmtManager, "ii", $dataNumManager['c'], $_POST['ctid']);
                        mysqli_stmt_execute($stmtManager);
                    } else {
                        $sql = "UPDATE `admin` SET username=?, password=? WHERE aid=" . $_GET['edit'];
                        $stmt = mysqli_prepare($conn, $sql);
                        $stmt->bind_param("ss", $_POST['username'], md5($_POST['password']));
                        $stmt->execute();

                        $sqlManager = "UPDATE `centerrole` SET ctid=? WHERE aid=" . $_GET['edit'];
                        $stmtManager = mysqli_prepare($conn, $sqlManager);
                        mysqli_stmt_bind_param($stmtManager, "i", $_POST['ctid']);
                        mysqli_stmt_execute($stmtManager);
                    }
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
                                        <p class="text-small text-muted mb-2">Данные об менеджере</p>
                                        <div class="row g-0 mb-2">
                                            <form id="<?php echo $idAttr; ?>" rel="<?php echo $editId; ?>" name="author_profile" method="POST">
                                                <div class="form-group m-2">
                                                    <label for="username" class="mb-1">
                                                        Имя пользователя
                                                    </label>
                                                    <input type="text" name="username" class="form-control" id="username" placeholder="Имя пользователя" value="<?php echo $dataEditInputs['username'] ?>" required>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="password" class="mb-1">
                                                        Пароль
                                                    </label>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="ctid" class="mb-1">
                                                        Центр
                                                    </label>
                                                    <br />
                                                    <select class="form-control" name="ctid" id="ctid">
                                                        <?php
                                                        $sqlCenters = "select * from `center`";
                                                        $resCenters = $conn -> query($sqlCenters);
                                                        while ($dataCenters = mysqli_fetch_assoc($resCenters)) {
                                                        ?>
                                                            <option value="<?php echo $dataCenters['ctid'] ?>"><?php echo $dataCenters['ctname'] ?></option>
                                                        <?php } ?>
                                                    </select>
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
    <!-- Page Specific Scripts End -->
</body>

</html>