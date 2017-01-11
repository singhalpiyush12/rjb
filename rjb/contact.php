<html>
	<head>
		<link rel="stylesheet" href="styleform.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <title>Rajendra Bhawan</title>
	  <link rel="icon" type="image/png" href="logo.png">
	  <link rel="stylesheet" href="rjbstyle.css" type="text/css"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	   <script src="jquery-3.1.1.min.js"></script>
	</head>
	<body>
	<div class="contact">
	  <header>
	    <img src="name.png" width="90%" height="20%">
	 </header>



	 <div class="testslider">
	 <div class="ul">
	 <ul>
	 <li><img class="test" src="rjb.jpg" style="width:600px"></li>
	  <li><img class="test" src="rjbgate.jpg" style="width:600px"></li>
	  <li><img class="test" src="MESS.jpg" style="width:600px"></li>
	  <li><img class="test" src="CANTEEN.jpg" style="width:600px"></li>
	  </ul>
	 </div>
	 </div>
    <script>
    var m=0;
  var slideIndex = 1;
  showDivs(slideIndex);
  function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("test");
  if (slideIndex > x.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = x.length}
  	
   document.getElementsByClassName("ul")[0].style.top='-'+parseInt(410*(slideIndex-1))+'px';
  
       slideIndex++;
       $(".test").fadeIn(2500);
       $(".test").fadeOut(2500);
      
  setTimeout(showDivs,5000);
}
    </script>






	 <nav>
	  <ul>
		  <li><a href="rjb.htm">Home</a></li>
		  <li><a href="council.htm">Council</a></li>
		  <li><a href="facility.htm">Facilities</a></li>
		  <li><a href="activity.htm">Activities</a></li>
		  <li><a href="notice.htm">Notices</a></li>
		  <li><a href="contact.php">Contact</a></li>
	   </ul>
	  </nav>
	</div>
		<div class="myform">
		<?php
			include 'showerr.php';
			$SeeError=0;
			$host='localhost';
			$user='root';
			$pass='me';
			function format($data) {
  				$data = trim($data);
  				$data = stripslashes($data);
  				$data = htmlspecialchars($data);
  				return $data;
			}
			$name=$email=$mobile=$branch=$room=$enroll=$comment='';
			$nameErr=$emailErr=$mobileErr=$branchErr=$roomErr=$enrollErr='';
			if ($_SERVER["REQUEST_METHOD"] == "POST"){

				if(empty($_POST["name"])){
					$nameErr="* The name field is required";
					$SeeError=1;
				}
				else{
					$name=format($_POST["name"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  						$nameErr = "Entered name is not a valid name";
  						$SeeError=1;
  					}
				}

				if(empty($_POST["email"])){
					$emailErr="* The EMAIL field is necessery";
					$SeeError=1;
				}
				else{
					$email=format($_POST["email"]);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  						$emailErr = "Email provided is not a valid email"; 
  						$SeeError=1;
					}
				}

				if(empty($_POST["mobile"])){
					$mobileErr="* The MOBILE NAME field is required";
					$SeeError=1;
				}
				else
					$mobile=format($_POST["mobile"]);
				if(empty($_POST["enroll"])){
					$enrollErr="* The enrollment no. is required";
					$SeeError=1;
				}
				else
					$enroll=format($_POST["enroll"]);

                 if(empty($_POST["room"])){
                 $roomErr="where do you sleep";
                 $SeeError=1;
                 }
                 else
				$room=format($_POST["room"]);

				if(empty($_POST["branch"])){
					$branchErr="* Branch is required";
					$SeeError=1;
				}
				else
					{$branch=format($_POST["branch"]);}
				$comment=format($_POST["comment"]);

			if($SeeError===0){
			$mysqli = new mysqli('localhost','root','me','piyush');


		  if ($mysqli->connect_error) {
		    die('Connect Error (' . $mysqli->connect_errno . ') '
		            . $mysqli->connect_error);
		}
			else{
				$sql="INSERT INTO info(Name,Enrollment,Mobile,Branch,Email,RoomNo,Comment)
				 VALUES ('$name','$enroll','$mobile','$branch','$email','$room','$comment') ";
				
				$retval = mysqli_query($mysqli,$sql);
				if(!$retval ){
  						die('Could not enter data: ' . mysql_error());
				}
				$message = "Data entered have been Saved in the DATABASE";
				echo "<script>alert('$message');</script>";
				mysqli_close($mysqli);
			}
		}
	}
		?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<fieldset>
<legend><span class="number">1</span> BASIC Info</legend>

NAME :<p class="error"> <span class="error"><?php echo $nameErr; ?></span></p>

<input type="text" name="name" placeholder="Your Name *" value="<?php echo $name; ?>" required>

ENROLLMENT : <p class="error"><span class="error"><?php echo $enrollErr ?></span></p>

<input type="text" name="enroll" placeholder="Your Enrollment *" value="<?php echo $enroll; ?>">

E-MAIL : <p class="error"><span class="error"><?php echo $emailErr; ?></span></p>

<input type="email" name="email" placeholder="Your Email *" value="<?php echo $email; ?>" required>

MOBILE : <p class="error"><span class="error"><?php echo $mobileErr ?></span></p>

<input type="text" name="mobile" placeholder="Your Mobile *" value="<?php echo $mobile; ?>">


Room No. :<p class="error"><span class="error"><?php echo $roomErr ?></span></p>
<input type="text" name="room" placeholder="RoomNo *" value="<?php echo $room; ?>">

Branch:<p class="error"><span class="error"><?php echo $branchErr ?></span></p>
<select id="branch" name="branch" value="<?php echo $branch; ?>">
  <option value="cs">Computer Science</option>
  <option value="ece">Electronics & Communication</option>
  <option value="electrical">Electrical</option>
  <option value="Mechanical">Mechanical</option>
  <option value="civil">Civil</option>
  <option value="chemical">Chemical</option>
  <option value="meta">Metallurgy</option>
  <option value="p&i">Production and Industrial</option>
  <option value="biotech">Biotechnology</option>
   <option value="applied maths">Applied Maths</option>
</select> 
Comment/Suggestions:
<textarea name="comment" placeholder="Suggestions" value="<?php echo $comment; ?>" rows="4"> </textarea>   
</fieldset>
<input type="submit" value="Apply"/>
<input type="reset" value="RESET"/>
<div class="cleardiv"></div>
</form>
</div>
</body>
</html>
