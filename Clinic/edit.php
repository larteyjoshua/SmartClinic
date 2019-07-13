
<?php
    include ('server.php');
    // session_start();
                // THIS BLOCK IS FOR CHECKING THE VERSION AND STARTING THE SESSION
                if (version_compare(PHP_VERSION, '7.00')>=0)
                {
                  // PHP>=7
                  session_start(['cache_limiter'>= 'private', 'read_and_close'=> true,]);
                }
                else{
                  // php <7
                  session_start();

                }

                //DISABLING BACK KEY LOGIN
                if (!isset($_SESSION['fname'])) {
                  header('Location: index-2.php');
                  exit();
                   }
                // echo 'Logged in as '.$_SESSION['fname'];
              // THIS IS FOR DATA COLLECTION
        if($_SERVER['REQUEST_METHOD']=='POST'){
          
          if(isset($_POST['department']) && $_POST['department']!== "" && isset($_POST['pNum']) && $_POST['pNum']!== "" && isset($_POST['date']) && $_POST['date']!==""){          
            $date = $connection->real_escape_string($_POST['date']);
            $time = $connection->real_escape_string($_POST['time']);


            $message = $connection->real_escape_string($_POST['message']);
            $lname=$_SESSION['lname'];
            $fname=$_SESSION['fname'];
            $email=$_SESSION['email'];
            $pNum=$_SESSION['pNum'];
            $id=$_SESSION['id'];
             
            $department=$_SESSION['department'];
            $message=$_SESSION['message'];
            $app_date=$_SESSION['app_date'];
            $app_time=$_SESSION['app_time'];
            $app_id=$_SESSION['app_id']; 

            

                  switch($_POST['department']){
                    case '1.':
                    $department='Physio';
                    break;

                    case '2.':
                    $department='Paediatrics';
                    break;

                    case '3.':
                    $department='Dental';
                    break;

                    case '4.':
                    $department='Gyaenacology';
                    break;

                    case '5.':
                    $department='Physio';
                    break;

                    case '6.':
                    $department='Ear or Eye';
                    break;

                    default:
                    $department = 'Not selected';
                    break;
                  }

            //CHECKING FOR ALREADY BOOKED DATE AND TIME
            $chk = "SELECT * FROM appointment where app_time = '$time' AND app_date='$date'";
            $checks= mysqli_query($connection,$chk);

            if (mysqli_num_rows($checks)==1){
              echo "<script> alert('Date and time already Booked!');</script>";
            }
            else{

               //STORING EVERYTHING IN THE DATABASE
                $insert="INSERT INTO appointment(fname, lname, pNum, app_message, email, app_time, app_date, department, client_id) VALUES ('$fname', '$lname', '$pNum', '$message', '$email', '$time', '$date', '$department', '$id')";     
                if($connection->query($insert)==true){
                  




                  echo "<script>document.writeln('Appointment successfully Booked!');</script>";
                  header( "refresh:1;url=index-2.php" );
      
                }
                

                else
                  echo "<script>alert('Failed to submit appointment');</script>";
                }

            }

          else{
            echo "<script> alert ('Fill all the fields')</script>;"; //SHOWING THAT NOT ALL FIELDS HAVE INPUTS
          }
            
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>SmartClinic Appointment</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="Login/css/util.css">
  <link rel="stylesheet" type="text/css" href="Login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="container">
        <form method = "POST" action="appointment.php" class="login100-form validate-form">
          <span class="login100-form-title p-b-70">
            Makes an Appointment
          </span>
          <form method="POST" action="appointment.php">

            <div  class="form-group" data-validate="Enter your full name">
              <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
              <input type ="text" name ="fullName" class="form-control" id="appointment_name" value = "<?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?>">
            </div>
            
            <div  class="form-group" data-validate="Phone Number">
              <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
              <input type="text" name ="pNum" class="form-control" id="appointment_name" value=<?php echo $_SESSION['pNum']?>>
              &nbsp;
              <div class="form-group">
                  <div class="form-group">
                    <div class="">
                      <!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div> -->
                    Deparment  <select name="department" id="department_name" class="form-" label="Department" value=<?php echo $_SESSION['department']?>>
                        <option value="0."> General </option>
                        <option value="1"> Physio</option>
                        <option value="2.">Paediatrics</option>
                        <option value="3.">Dental</option>
                        <option value="4.">Gyaenacology</option>
                        <option value="5.">Physio</option>
                        <option value="6.">Eye or Ear</option>
                      </select>
                    </div>
                  </div>
                </div>

            <div class="form-group" data-validate="Enter your email">
              <!-- <label for="appointment_email" class="text-black">Email</label> -->
              <input type="email" name="email" class="form-control" id="appointment_email" value=<?php echo $_SESSION['email']; ?>>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <!-- <label for="appointment_date" class="text-black">Date</label> -->
                  <input type="date" name="date" class="form-control appointment_date"  value=<?php echo $_SESSION['app_date']?>>
                </div>    
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <!-- <label for="appointment_time" class="text-black">Time</label> -->
                  <input type="time" name="time" id="appointment_time" class="form-control appointment_time"  value=<?php echo $_SESSION['app_time']?>>
                </div>
              </div>
            </div>
            

            <div class="form-group">
              <!-- <label for="appointment_message" class="text-black">Message</label> -->
              <textarea type= "text" name="message"  class="form-control" cols="30" rows="6"  value=<?php echo $_SESSION['message']?>></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Make an Appointment" class="btn btn-primary">
            </div>
            <div class="nav-item"><a href="history.php" class="nav-link"><span>History</span></a></div>            
            <div class="form-group">
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
<!--===============================================================================================-->
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