<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SmartClinic</title>

  <!-- css -->
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css">
  <link href="css/nivo-lightbox.css" rel="stylesheet" />
  <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
  <link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
  <link href="css/owl.theme.css" rel="stylesheet" media="screen" />
  <link href="css/animate.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">

  <!-- boxed bg -->
  <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
  <!-- template skin -->
  <link id="t-colors" href="color/default.css" rel="stylesheet">








</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">


  <div id="wrapper">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
      <div class="top-area">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-6">
              <p class="bold text-left">Monday - Saturday, 8am to 11pm </p>
            </div>
            <div class="col-sm-6 col-md-6">
              <p class="bold text-right">Call us now +233 249 643 365</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container navigation">

        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
          <a class="navbar-brand" href="index-2.php">
                    <img src="img/logo.png" alt="" width="150" height="40" />
                </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index-2.php">Home</a></li>
            <li><a href="index-2.php#service">Service</a></li>
            <li><a href="index-2.php#doctor">Doctors</a></li>
            <li><a href="index-2.php#facilities">Facilities</a></li>
            <li><a href="index-2.php#pricing">Pricing</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="appointment.php">book an appointment</a></li>
            <li><a href="index.php">Log out</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
<style>
    table{
      border-collapse: collapse;
      width:90%;
      color: #588c7e;
      font-family: monospace;
      font-size: 20px;
      margin-bottom: 5%;
      margin-top:12%;
      text-align: left;  
    }
    th{
      background-color: #588c7e;
      color: white;
    }
    tr:hover{background-color: aliceblue}
   {
     background-color: #588c7e
   }
   .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
  </style>
   <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

        <?php
                    // Include config file
                    $username = "root"; 
                    $password = ""; 
                    $database = "smartclinic"; 
                    $mysqli = new mysqli("localhost", $username, $password, $database); 

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
                  header('Location: login.php');
                  exit();
                   }
              // THIS IS FOR DATA COLLECTION
        
            $fname = $_SESSION['fname'];
            $lname = $_SESSION['lname'];
            $email = $_SESSION['email'];
                    
                    // Attempt select query execution
                    $sql = "SELECT app_id, fname, lname, pNum,app_message,app_date,TIME_FORMAT(app_time, '%h:%i %p')app_time, department FROM appointment Where email ='$email'";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table align='center' width='80%' border='3' >";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>App ID</th>";
                                         echo "<th>Brief Description of Condition</th>";
                                        echo "<th>Date</th>";
                                         echo "<th>Time</th>";
                                         echo "<th>Department</th>";
                                          echo "<th>Phone Number</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['app_id'] . "</td>";
                                        echo "<td>" . $row['app_message'] . "</td>";
                                        echo "<td>" . $row['app_date'] . "</td>";
                                        echo "<td>" . $row['app_time'] . "</td>";
                                        echo "<td>" . $row['department'] . "</td>";
                                        echo "<td>" . $row['pNum'] . "</td>";
                                        echo "<td>";
                                             echo "<a href='update.php?app_id=". $row['app_id'] ."' title='Edit Appointment' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?app_id=". $row['app_id'] ."' title='Delete Appointment' data-toggle='tooltip'><span class='glyphicon glyphicon-remove'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
</section>
    <footer>

      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget" id="about">
                <h5>About SmartClinic</h5>
                <p>
                  We are an online medical booking service in one of the best Private hospitals in Ghana. We are located at Cape Coast, Abura near the Internal Revenue Office. We booked a service and we will welcome you with a nice smile. 
                </p>
              </div>
            </div>
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Information</h5>
                <ul>
                  <li><a href="index-2.php">Home</a></li>
                  <li><a href="index-2.php">Laboratory</a></li>
                  <li><a href="index-2.php">Medical treatment</a></li>
                  <li><a href="index-2.php">Terms & conditions</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>SmartClinic center</h5>
                <p>
                  The best online Hospital in Ghana.
                </p>
                <ul>
                  <li>
                    <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
                </span> Monday - Saturday, 8am to 11pm
                  </li>
                  <li>
                    <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                </span> +233 249 643 365
                  </li>
                  <li>
                    <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                </span> smartclinic@gamil.com
                  </li>

                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Our location</h5>
                <p>Cape Coast, Abura near internal Revenue office</p>

              </div>
            </div>
            <div class="wow fadeInDown" data-wow-delay="0.1s">
              <div class="widget">
                <h5>Follow us</h5>
                <ul class="company-social">
                  <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                  <li class="social-dribble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sub-footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="wow fadeInLeft" data-wow-delay="0.1s">
                <div class="text-left">
                  <p></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="wow fadeInRight" data-wow-delay="0.1s">
                <div class="text-right">
                  <div class="credits">
                    <a href="" target="_blank">Group 18 HCL Team </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </div>
  <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

  <!-- Core JavaScript Files -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/jquery.scrollTo.js"></script>
  <script src="js/jquery.appear.js"></script>
  <script src="js/stellar.js"></script>
  <script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/nivo-lightbox.min.js"></script>
  <script src="js/custom.js"></script>

  <script>if( window.self == window.top ) { (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-55234356-4', 'auto'); ga('send', 'pageview'); } </script>
</body>


</html>
