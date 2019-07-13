<?php
// Include config file
$username = "root"; 
$password = ""; 
$database = "smartclinic"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
 
 $app_date_err = "";
 $app_time_err = "";
 $app_message_err = "";
 $department_err = "";

   if($_SERVER['REQUEST_METHOD']=='POST'){

         // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_app_date = trim($_POST["app_date"]);

    if(empty($input_app_date)){
        $app_date_err = "Please enter valid date.";
    } else{
        $app_date = $input_app_date;
    }
    
    // Validate address address
    $input_app_message = trim($_POST["app_message"]);
    if(empty($input_app_message)){
               $app_message_err = "Please enter an a description of your condition.";
    } else{
        $app_message = $input_app_message;
    }
    
    // Validate salary
    $input_app_time = trim($_POST["app_time"]);
    if(empty($input_app_time)){    
          $app_time_err = "Please enter a correct time.";
    } else{
        $app_time = $input_app_time;
    }

    // Validate salary
    $input_department = trim($_POST["department"]);
    if(empty($input_department)){
        $department_err = "Please chose a department.";     
    } else{
        $department = $input_department;
    }
    
    // Check input errors before inserting in database
    if(empty($app_date_err) && empty($app_message_err) && empty($app_time_err) && empty($department_err)){
        // Prepare an update statement
        $sql = "UPDATE appointment SET app_date = ?, app_message = ?, app_time = ?, department = ? WHERE app_id = ?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Set parameters
            $param_app_message=$app_message;
              $param_id=$id;
             $input_app_date;
             $input_app_time;
             $input_department;


            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssi", $input_app_date, $param_app_message, $input_app_time,$input_department, $param_id);
            
            
            
            // Attempt to execute the prepared statement
            // echo $stmt->execute();

            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: history.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }

        // Close statement
        // $stmt->close();
        }
        
    }
    
    // Close connection
    // $mysqli->close();
   }

     
    // Check existence of id parameter before processing further
    if(isset($_GET["app_id"]) && !empty(trim($_GET["app_id"]))){
        // Get URL parameter
        $id =  trim($_GET["app_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM appointment WHERE app_id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $id);
            
            // // Set parameters
            // $param_app_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $app_date = $row["app_date"];
                    $app_message = $row["app_message"];
                    $app_time = $row["app_time"];
                    $department = $row["department"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: history.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // // Close statement
        // $stmt->close();
        } else {
            echo "error in statement";
        }
        
        
        
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: history.php");
        exit();
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Appointment</title>
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
                        <h2>Edit Appointment </h2>
                    </div>
                    <p>Please edit the input values and submit to edit appointment.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($app_date_err)) ? 'has-error' : ''; ?>">
                            <label>Date Of Appointment</label>
                            <input type="date" name="app_date" class="form-control" value="<?php echo $app_date; ?>">
                            <span class="help-block"><?php echo $app_date_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($app_message_err)) ? 'has-error' : ''; ?>">
                            <label>Brief description of Condition</label>
                            <textarea name="app_message" class="form-control"><?php echo $app_message; ?></textarea>
                            <span class="help-block"><?php echo $app_message_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($app_time_err)) ? 'has-error' : ''; ?>">
                            <label>Time of Appointment </label>
                            <input type="time" name="app_time" class="form-control" value="<?php echo $app_time; ?>">
                            <span class="help-block"><?php echo $app_time_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                  <div class="form-group">
                    <div class="">
                      <!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div> -->

                    Deparment  <select name="department" id="department_name" class="form-control" >
                        <option value="General" <?php echo $department == "General" ? 'selected' : ''; ?>> General </option>
                        <option value="Physio" <?php echo $department == "Physio" ? 'selected' : ''; ?>> Physio</option>
                        <option value="Paediatrics" <?php echo $department == "Paediatrics" ? 'selected' : ''; ?>>Paediatrics</option>
                        <option value="Dental" <?php echo $department == "Dental" ? 'selected' : ''; ?>>Dental</option>
                        <option value="Gyaenacology" <?php echo $department == "Gyaenacology" ? 'selected' : ''; ?>>Gyaenacology</option>
                        <option value="Eye or Ear" <?php echo $department == "Eye or Ear" ? 'selected' : ''; ?>>Eye or Ear</option>
                      </select>
                      <span><?php echo $department_err;?></span>
                    </div>
                  </div>
                </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="history.php" class="btn btn-default">Cancel</a>
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
</body>
</html>