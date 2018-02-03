<?php 
    session_start();

    $_SESSION['car_id'] = "";
    if (isset($_POST['search'])){

        $_SESSION['car_id'] = test_input($_POST['car_chassis']);

        header("Location: format.php");
    }

    function test_input($data) {

		if(empty($data)){
			global $error;
			$error = "Field is required";
		}

		else{

		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		}
		
		return $data;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
       <link rel="stylesheet" href="CSS/owl.carousel.css">
        <link rel="stylesheet" href="CSS/animate.css">
        <link rel="stylesheet" href="CSS/main.css">
         <link rel="stylesheet" href="CSS/text.css">
        <link rel="stylesheet" href="CSS/responsive.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" id="theme" rel="stylesheet">
    </head>
    <body id="body">
          	<div id="preloader">
    		<div class="book">
    		  <div class="book__page"></div>
    		  <div class="book__page"></div>
    		  <div class="book__page"></div>
    		</div>
    	</div>
	    <div class="navbar-default navbar-fixed-top" id="navigation">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
	                    <span class="sr-only"></span>
	                    <span class="l-lite">Menu</span>
	                   
	                </button>
	                <a class="navbar-brand" href="#">
                       <img src="IMG/CarSecureLogo.png" alt="logo">
	                </a>
	            </div>
	            <nav class="collapse navbar-collapse" id="navbar">
	                <ul class="nav navbar-nav navbar-right" id="top-nav">
	                    <li><a href="#"> <i class="fa fa-info-circle"></i> About Us</a></li>
                        <!--<li class="dropdown shutter-out-horizontal b_pad buzz-out color">                            
                            <a href="#" class="dropdown-toggle b_slidet b_items" data-toggle="modal" data-target="#popwindow"><i class="fa fa-user lk"></i>  Log In or Sign Up <span class="caret opacity-none"></span></a>
                         </li>-->
                         <li id="myBtn" class="color"><a href="#"><i class="fa fa-user lk"></i> Log In or Sign Up</a></li>
	                </ul>
	            </nav>
	        </div>
	    </div>
<!-- The User Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" id="m-content">
    <div class="modal-header" id="m-head">
            <span class="close">&times;</span>
    </div>
    <div class="modal-body" id="l-flex-body">
       
        <a href="login.php"><div class="l-flex-items">
        <img src="IMG/img_avatar2.png" width="100" height="100" class="reg">
        <span class="l-reg">Log In</span>
        </div></a>
         <a href="registration.php"><div class="l-flex-items l-flex-item2 pull-right">
                <img src="IMG/img_avatar5.png" width="100" height="100" class="reg">
               <span class="l-reg">Sign Up</span>
                </div>
        </div></a>
    </div>
  
</div>

	    <section id="hero-area">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-6">
	                    <div class="block">
	                        <h1 class="wow fadeInDown">Authenticate a Vehicle</h1>
	                        <p class="wow fadeInDown" data-wow-delay="0.3s">Using the latest chassis technology, we protect your vehicle</p>
	                        <div class="wow fadeInDown" data-wow-delay="0.3s">
	                        	  <div id="l_up" class="js-location-search location-search location-search-main-page  location_city_area">
    <div class="location-search-inner" id="l-ji">
<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method = "post" role="form" class="form-vertical" novalidate="novalidate" autocomplete="off">

    <div class="area" id="l_area">
    <label for="area" class="required">Select for Chassis Number</label>
    <input type="text" id="l-border" name="car_chassis" required="required" data-prefill="location.areaName" class="form-control" placeholder="Search for Chassis Number" />
    <span id="area-not-selected-error" class="help-inline">
        
    </span>
</div>
  <div class="find-food" id="l_areaa">
    <input type="submit" id="button" name="search" value="SHOW RESULTS" class="btn btn-primary btn-block">
</div>
        <input type="hidden" id="area_id" name="area_id" data-prefill="location.areaId" /><input type="hidden" id="pickup" name="pickup" /><input type="hidden" id="sort" name="sort" /><input type="hidden" id="tracking_id" name="tracking_id" data-prefill="location.tracking_id" /></form>
    </div>
</div>
    </div>
	                        </div>
	                    </div>
	                </div>
	              
	                </div>
	            </div>
	        </div>
	    </section>
        <!--<div class="modal fade" id="popwindow">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" class="close">&times</button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>-->
        
        <script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="js/jquery.lwtCountdown-1.0.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.nav.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
            </script>
    </body>
</html>
