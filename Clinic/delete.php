<?php


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
        
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            
            // Records deleted successfully. Redirect to landing page
             header("location: history.php");
             exit();
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
        header("location: history.php");
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
    <style>
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
                        <h1>Appointment delation</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="app_id" value="<?php echo trim($_GET["app_id"]); ?>"/>
                            <p>Are you sure you want to delete this appointment?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="history.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>