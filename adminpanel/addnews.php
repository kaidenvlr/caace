<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}


$dbname = "p-331683_GTH";

$editId = $_GET['editId'];
if (!empty($editId)) {
    $sqlEditInputs = 'select ntitle, nslogan, ncontent from `news` where nid=' . $editId;
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
                                <a href="./news.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                                    <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                                    <span class="text-small align-middle">Новости</span>
                                </a>
                                <h1 class="mb-0 pb-0 display-4" id="title"><?php echo empty($editId) ? 'Создание новости' : 'Редактирование новости №' . $editId; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <?php
                if (isset($_POST['save'])) {
                    if (empty($_GET['editId'])) {
                        $sql = "INSERT INTO `news` (ntitle, nslogan, ncontent) VALUES (?, ?, ?)";

                        $stmt = mysqli_prepare($conn, $sql);
                        echo $_POST['nid'];
                        mysqli_stmt_bind_param($stmt, "sss", $_POST['ntitle'], $_POST['nslogan'], $_POST['ncontent']);
                        mysqli_stmt_execute($stmt);

                        $sql = "select max(nid) c from `news`;";
                        $res = $conn->query($sql);
                        $data = mysqli_fetch_assoc($res);


                        $targetDir = "uploads/";
                        $allowTypes = array('jpg', 'png', 'jpeg');

                        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                        echo 1;
                        echo $_FILES['files']['name'];
                        echo 2;
                        $fileNames = array_filter($_FILES['files']['name']);
                        if (!empty($fileNames)) {
                            foreach ($_FILES['files']['name'] as $key => $val) {

                                $fileName = basename($_FILES['files']['name'][$key]);
                                $targetFilePath = $targetDir . $data['c'] . $fileName;


                                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                if (in_array($fileType, $allowTypes)) {
                                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                                        $insertValuesSQL .= "(" . $data['c'] . ", '" . $data['c'] . $fileName . "'),";
                                    } else {
                                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                                    }
                                } else {
                                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                                }
                            }

                            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                            $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;

                            if (!empty($insertValuesSQL)) {
                                $insertValuesSQL = trim($insertValuesSQL, ',');
                                $insert = $conn->query("INSERT INTO `newsimage` (nid, nimgname) VALUES $insertValuesSQL");
                                $conn->commit();

                                if ($insert)
                                    $statusMsg = "Files are uploaded successfully." . $errorMsg;
                                else
                                    $statusMsg = "Sorry, there was an error uploading your file.";
                            } else {
                                $statusMsg = "Upload failed! " . $errorMsg;
                            }
                        } else {
                            $statusMsg = 'Please select a file to upload.';
                        }
                        echo $statusMsg;
                    } else {
                        $sql = "UPDATE `news` SET ntitle=?, nslogan=?, ncontent=? WHERE nid=" . $editId;
                        $stmt = mysqli_prepare($conn, $sql);
                        $stmt->bind_param("sss", $_POST['ntitle'], $_POST['nslogan'], $_POST['ncontent']);
                        $stmt->execute();

                        $sql = "select max(ctid) c from `news`;";
                        $res = $conn->query($sql);
                        $data = mysqli_fetch_assoc($res);

                        $sqlDeleteImages = "delete from `newsimage` where nid=" . $editId;
                        $resDeleteImages = $conn->query($sqlDeleteImages);

                        $targetDir = "uploads/";
                        $allowTypes = array('jpg', 'png', 'jpeg');

                        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                        $fileNames = array_filter($_FILES['files']['name']);
                        if (!empty($fileNames)) {
                            foreach ($_FILES['files']['name'] as $key => $val) {
                                $fileName = basename($_FILES['files']['name'][$key]);
                                $targetFilePath = $targetDir . $data['c'] . $fileName;

                                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                if (in_array($fileType, $allowTypes)) {
                                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                                        $insertValuesSQL .= "(" . $editId . ", '" . $editId . $fileName . "'),";
                                    } else {
                                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                                    }
                                } else {
                                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                                }
                            }

                            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                            $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;

                            if (!empty($insertValuesSQL)) {

                                $insertValuesSQL = trim($insertValuesSQL, ',');
                                $insert = $conn->query("INSERT INTO `newsimage` (nid, nimgname) VALUES $insertValuesSQL");
                                $conn->commit();

                                if ($insert)
                                    $statusMsg = "Files are uploaded successfully." . $errorMsg;
                                else
                                    $statusMsg = "Sorry, there was an error uploading your file.";
                            } else {
                                $statusMsg = "Upload failed! " . $errorMsg;
                            }
                        } else {
                            $statusMsg = 'Please select a file to upload.';
                        }
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
                                        <p class="text-small text-muted mb-2">Данные о новости</p>
                                        <div class="row g-0 mb-2">
                                            <form enctype="multipart/form-data" rel="<?php echo $editId; ?>" name="author_profile" method="POST">
                                                <div class="form-group m-2">
                                                    <label for="ntitle" class="mb-1">
                                                        Заголовок
                                                    </label>
                                                    <input type="text" name="ntitle" class="form-control" id="ntitle" placeholder="Заголовок" value="<?php echo $dataEditInputs['ntitle'] ?>" required>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="nslogan" class="mb-1">
                                                        Краткое описание
                                                    </label>
                                                    <input type="text" name="nslogan" class="form-control" id="nslogan" placeholder="Слоган" value="<?php echo $dataEditInputs['nslogan'] ?>" required>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="ncontent" class="mb-1">
                                                        Контент
                                                    </label>
                                                    <textarea name="ncontent" class="form-control" id="ncontent" placeholder="Контент" required><?php echo $dataEditInputs['ncontent'] ?></textarea>
                                                </div>
                                                <div class="form-group m-2">
                                                    <label for="images" class="mb-1">
                                                        Изображения
                                                    </label>
                                                    <input type="file" class="form-control" name="files[]" id="images" multiple>
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