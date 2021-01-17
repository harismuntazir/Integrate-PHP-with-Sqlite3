<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FPS IDs Locator - BadTools</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div>
    <div class="container">
        <div class="col-md-12">
            <h1 class="text-center" style="margin-top:10px;color:rgb(138,3,244);">FPS IDs Locator - RC Lists</h1>
            <div class="row justify-content-center align-items-center align-content-center align-self-center">
                <form method="POST" action="index.php">
                    <div class="col-auto align-self-center" style="margin-top:10px;"><input class="form-control-lg" required="required" type="search" name="search" placeholder="Type To Search .." autofocus="" style="width:400px;"></div>
                </form>
                <div class="col-md-12">
                    <p class="text-center" id="alert" style="margin-top:10px; display: none"></p>
                </div>
            </div>
        </div>
    </div>


    <?php
    if(isset($_POST['search'])) {
    $search = $_POST['search'];
    if(strlen($search) < 4) {
        require_once "index.php";
        ?>
        <script type="text/javascript">
            let alert = document.getElementById("alert");
            alert.style.display = "block";
            alert.innerHTML="Your Search Term Can't Be Less Than 4 Characters !";
        </script>
        <?php
           exit;
    }
    $search = trim($search);

    require_once "server.php";

    $get = @$db->query("SELECT * FROM fps_ids_rc_lists WHERE FPSName LIKE '%$search%'");
    $num_rows = 0;
    while ($col = $get->fetchArray()) {
    $DistrictName = $col['DistrictName'];
    $SubDistrictName = $col['SubDistrictName'];
    $FPSID = $col['FPSID'];
    $FPSName = $col['FPSName'];

    $expStore = explode("(", "$FPSName");
    $StoreName = $expStore[0];
    $expName = explode("-", "$FPSName");
    $Name = $expName[1];
    $num_rows++;
    //set the alert message
    ?>

    <div class="container">
        <div class="card" style="background-color:rgba(244,244,244,0.4);">
            <div class="card-body" style="margin-top:10px;padding-bottom:0px;">
                <h4 class="card-title"><?php echo $FPSID; ?></h4>
                <h6 class="text-muted card-subtitle mb-2"><?php echo $Name; ?></h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr></tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width:500px;">Store Name</td>
                            <td><?php echo $StoreName; ?></td>
                        </tr>
                        <tr>
                            <td>District Name</td>
                            <td><?php echo $DistrictName; ?></td>
                        </tr>
                        <tr style="margin-bottom:0px;">
                            <td>Sub District Name</td>
                            <td><?php echo $SubDistrictName; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
}
else {
    require_once "index.php";
}
?>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php
if(isset($_POST['search'])) {
    ?>
    <script type="text/javascript">
        let alert = document.getElementById("alert");
        alert.style.display = "block";
        alert.innerHTML = "<?php echo "Your Search " . ucwords($search)  . " Resulted In " . $num_rows . " Records";?>";
    </script>
    <?php
}
?>
</body>

</html>