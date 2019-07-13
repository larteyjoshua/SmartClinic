<?php

//page number ie dental, general etc
if(isset($_GET["page"]) && !empty($_GET["page"])){ 

$pageId = $_GET['page'];
}

// Process delete operation after confirmation
if(isset($_POST["app_id"]) && !empty($_POST["app_id"])){
    // Include config file
    $username = "root"; 
     $password = ""; 
$database = "smartclinic"; 
$mysqli = new mysqli("localhost", $username, $password, $database);
    // Prepare a delete statement
    $sql = "DELETE FROM appointment WHERE app_id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["app_id"]);

        $page = $_POST['page'];
        
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){

            switch ($page) {
                case 0:
                    header('Location: general.php?page=0');
                    exit();
                    break;
                case 1:
                    header('Location: dental.php?page=1');
                    exit();
                    break;

                case 2:
                    header('Location: eyeear.php?page=2');
                    exit();
                    break;
                case 3:
                    header('Location: paediatric.php?page=3');
                    exit();
                    break;
                case 4:
                    header('Location: physiological.php?page=4');
                    exit();
                    break;
                case 5:
                    header('Location: gynecological.php?page=5');
                    exit();
                    break;
                default:
                    # code...
                    break;
            }
            // Records deleted successfully. Redirect to landing page
            // header("location: view.php");
            // exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["app_id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: view.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comfirm Service</title>
   <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Patient Served Comfirmation</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-success fade in">
                            <input type="hidden" name="app_id" value="<?php echo trim($_GET["app_id"]); ?>"/>
                            <input type="hidden" name="page" value="<?php echo trim($_GET["page"]); ?>"/>
                            <p>Are you sure you have served this patient?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-success">
                                <a href="index-2.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>

       <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>
</body>
</html>