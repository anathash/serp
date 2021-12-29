<?php
include 'db_vars.php';
ini_set("display_errors", "stderr");

error_reporting(E_ALL);
$expire = time() + 60 * 60 * 24 ; //1day

$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

setcookie("user", '');
if (mysqli_connect_errno()) {
    echo "
        <script>
            alert('Failed to connect to MySQL');
            window.location.href='index.html';
        </script>";
}
if (isset($_POST['ID'])) {
    $amazon_id = $_POST["ID"];
	setcookie("user", $amazon_id, $expire);		
}
else{
	echo "
		<script>
			alert('Error on read user!');
			window.location.href='index.html';
		</script>";
}
$find_user ="SELECT * FROM serp_test.user_config WHERE amazon_id = ?";
$stmt = $db_connection->prepare($find_user);
$stmt->bind_param("s", $_POST['ID']);
$stmt->execute();
$stmt->bind_result($id, $amazon,$finished);
$result = $stmt->fetch();

if($finished !=""){
	echo "
			<script>
				alert('The test is finished, Thank you for participating. Don\'t forget to fill out the rest of the survey and enter your compilation verification code: $finished');
				window.location.href='index.html';
			</script>";
}


?>
<html lang="en">
<head>
    <title>SERP_test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design for Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/css/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        font-family: 'Josefin Sans', sans-serif;
    }

    body {

    }

    .login-box {
        width: 780px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #000000;
    }

    .login-box h1 {
        float: left;
        font-size: 40px;
        border-bottom: 6px solid #000000;
        margin-bottom: 50px;
        padding: 13px 0;
    }

    .textbox {
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        margin: 8px 0;
        border-bottom: 1px solid #000000;
    }

    .textbox i {
        width: 26px;
        float: left;
        text-align: center;
    }

    .textbox input {
        border: none;
        outline: none;
        background: none;
        color: #000000;
        font-size: 18px;
        width: 80%;
        float: left;
        margin: 0 10px;
    }

.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #04AA6D;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #04AA6D;
  cursor: pointer;
}

</style>
<body>
<br>
<div class="login-box">
    <div class="container">
        <div class="jumbotron cloudy-knoxville-gradient">
			<script>
					function validateFormSubmit() {
						var m = document.getElementById("gender_male").checked;
						var f = document.getElementById("gender_female").checked;
						var o = document.getElementById("gender_other").checked;
						if (!f && !m && !o) {
							alert("Please select your gender");
							return false;
						}
						return true;
					}
			</script>
            <div>
                <form action='submit.php' method='post'  onsubmit="return validateFormSubmit();">
					<div class="row">
						<p style="font-size:130%;"> Before we start, please supply the following personall details:</p>
					</div>
						<div class="row">
							<label for="age">Age:</label>
							<input type="number" id="age" name="age" min="1" max="100" required>
						</div>
						<br>
						<div class="row">
							<p>Gender: </p>
							<input type="radio" name="gender" id ="gender_female" value="female" >
							<label for="gender-female">Female</label><br>
							
							<input type="radio" name="gender" id ="gender_male" value="male">
							<label for="gender-male">Male</label><br>
							
							<input type="radio" name="gender" id ="gender_other" value="other">
							<label for="gender-other">Other</label><br>
						</div>
						<div >
							<fieldset>
							  <legend>Education Level</legend>
							  <select class="form-control dropdown" id="education_level" name="education_level" required>
								<option value="" selected="selected" disabled="disabled">-- select one --</option>
								<option value="No formal education">No formal education</option>
								<option value="Primary education">Primary education</option>
								<option value="Secondary education">Secondary education or high school</option>
								<option value="GED">GED</option>
								<option value="Vocational qualification">Vocational qualification</option>
								<option value="Bachelor's degree">Bachelor's degree</option>
								<option value="Master's degree">Master's degree</option>
								<option value="Doctorate or higher">Doctorate or higher</option>
							  </select>
							</fieldset>
						</div>
						<div >
							<fieldset>
								<legend>Education Field</legend>
								<select class="form-control dropdown" id="education_field" name="education_field">
									<option value="" selected="selected" disabled="disabled">-- select one --</option>
									<option value="Genetic Engineering and Biotechnology">Genetic Engineering and Biotechnology</option>
									<option value="Architecture">Architecture</option>
									<option value="Biochemistry">Biochemistry</option>
									<option value="Biomedical Science">Biomedical Science</option>
									<option value="Business Administration">Business Administration</option>
									<option value="Clinical Science">Clinical Science</option>
									<option value="Commerce">Commerce</option>
									<option value="Computer Applications">Computer Applications</option>
									<option value="Community Health">Community Health</option>
									<option value="Computer Information Systems">Computer Information Systems</option>
									<option value="Construction Technology">Construction Technology</option>
									<option value="Criminal Justice">Criminal Justice</option>
									<option value="Divinity">Divinity</option>
									<option value="Economics">Economics</option>
									<option value="Education">Education</option>
									<option value="Engineering">Engineering</option>
									<option value="Fine Arts">Fine Arts</option>
									<option value="Letters">Letters</option>
									<option value="Information Systems">Information Systems</option>
									<option value="Management">Management</option>
									<option value="Music">Music</option>
									<option value="Pharmacy">Pharmacy</option>
									<option value="Philosophy">Philosophy</option>
									<option value="Public Affairs and Policy Management">Public Affairs and Policy Management</option>
									<option value="Social Work">Social Work</option>
									<option value="Technology">Technology</option>
									<option value="Accountancy">Accountancy</option>
									<option value="American Studies">American Studies</option>
									<option value="American Indian Studies">American Indian Studies</option>
									<option value="Applied Psychology">Applied Psychology</option>
									<option value="Biology">Biology</option>
									<option value="Anthropology">Anthropology</option>
									<option value="Child Advocacy">Child Advocacy</option>
									<option value="Clinical Psychology">Clinical Psychology</option>
									<option value="Communication">Communication</option>
									<option value="Forensic Psychology">Forensic Psychology</option>
									<option value="Organizational Psychology">Organizational Psychology</option>
									<option value="Aerospace Engineering">Aerospace Engineering</option>
									<option value="Accountancy">Accountancy</option>
									<option value="Actuarial">Actuarial</option>
									<option value="Agriculture">Agriculture</option>
									<option value="Applied Economics">Applied Economics</option>
									<option value="Architecture">Architecture</option>
									<option value="Architectural Engineering">Architectural Engineering</option>
									<option value="Athletic Training">Athletic Training</option>
									<option value="Biology">Biology</option>
									<option value="Biomedical Engineering">Biomedical Engineering</option>
									<option value="Bible">Bible</option>
									<option value="Business Administration">Business Administration</option>
									<option value="Business Administration - Computer Application">Business Administration - Computer Application</option>
									<option value="Business Administration - Economics">Business Administration - Economics</option>
									<option value="Business and Technology">Business and Technology</option>
									<option value="Chemical Engineering">Chemical Engineering</option>
									<option value="Chemistry">Chemistry</option>
									<option value="Civil Engineering">Civil Engineering</option>
									<option value="Clinical Laboratory Science">Clinical Laboratory Science</option>
									<option value="Cognitive Science">Cognitive Science</option>
									<option value="Computer Engineering">Computer Engineering</option>
									<option value="Computer Science">Computer Science</option>
									<option value="Construction Engineering">Construction Engineering</option>
									<option value="Construction Management">Construction Management</option>
									<option value="Criminal Justice">Criminal Justice</option>
									<option value="Criminology">Criminology</option>
									<option value="Diagnostic Radiography">Diagnostic Radiography</option>
									<option value="Education">Education</option>
									<option value="Electrical Engineering">Electrical Engineering</option>
									<option value="Engineering Physics">Engineering Physics</option>
									<option value="Engineering Science">Engineering Science</option>
									<option value="Engineering Technology">Engineering Technology</option>
									<option value="English Literature">English Literature</option>
									<option value="Environmental Engineering">Environmental Engineering</option>
									<option value="Environmental Science">Environmental Science</option>
									<option value="Environmental Studies">Environmental Studies</option>
									<option value="Food Science">Food Science</option>
									<option value="Foreign Service">Foreign Service</option>
									<option value="Forensic Science">Forensic Science</option>
									<option value="Forestry">Forestry</option>
									<option value="History">History</option>
									<option value="Hospitality Management">Hospitality Management</option>
									<option value="Human Resources Management">Human Resources Management</option>
									<option value="Industrial Engineering">Industrial Engineering</option>
									<option value="Information Technology">Information Technology</option>
									<option value="Information Systems">Information Systems</option>
									<option value="Integrated Science">Integrated Science</option>
									<option value="International Relations">International Relations</option>
									<option value="Journalism">Journalism</option>
									<option value="Legal Management">Legal Management</option>
									<option value="Management">Management</option>
									<option value="Manufacturing Engineering">Manufacturing Engineering</option>
									<option value="Marketing">Marketing</option>
									<option value="Mathematics">Mathematics</option>
									<option value="Mechanical Engineering">Mechanical Engineering</option>
									<option value="Medical Technology">Medical Technology</option>
									<option value="Metallurgical Engineering">Metallurgical Engineering</option>
									<option value="Meteorology">Meteorology</option>
									<option value="Microbiology">Microbiology</option>
									<option value="Mining Engineering">Mining Engineering</option>
									<option value="Molecular Biology">Molecular Biology</option>
									<option value="Neuroscience">Neuroscience</option>
									<option value="Nursing">Nursing</option>
									<option value="Nutrition science">Nutrition science</option>
									<option value="Software Engineering">Software Engineering</option>
									<option value="Petroleum Engineering">Petroleum Engineering</option>
									<option value="Podiatry">Podiatry</option>
									<option value="Pharmacology">Pharmacology</option>
									<option value="Pharmacy">Pharmacy</option>
									<option value="Physical Therapy">Physical Therapy</option>
									<option value="Physics">Physics</option>
									<option value="Plant Science">Plant Science</option>
									<option value="Politics">Politics</option>
									<option value="Psychology">Psychology</option>
									<option value="Public Safety">Public Safety</option>
									<option value="Physiology">Physiology</option>
									<option value="Quantity Surveying Engineering">Quantity Surveying Engineering</option>
									<option value="Radiologic Technology">Radiologic Technology</option>
									<option value="Real-Time Interactive Simulation">Real-Time Interactive Simulation</option>
									<option value="Religion">Religion</option>
									<option value="Respiratory Therapy">Respiratory Therapy</option>
									<option value="Risk Management and Insurance">Risk Management and Insurance</option>
									<option value="Science Education">Science Education</option>
									<option value="Sports Management">Sports Management</option>
									<option value="Systems Engineering">Systems Engineering</option>
									<option value="Music in Jazz Studies">Music in Jazz Studies</option>
									<option value="Music in Composition">Music in Composition</option>
									<option value="Music in Performance">Music in Performance</option>
									<option value="Music in Theory">Music in Theory</option>
									<option value="Music in Music Education">Music in Music Education</option>
									<option value="Veterinary Technology">Veterinary Technology</option>
									<option value="military and strategic studies">military and strategic studies</option>							  
								</select>
							</fieldset>
						</div>						
						<div>
						<button class="btn peach-gradient" type="submit">Submit</button>
						</div>
                        
                    
                </form>

            </div>

        </div>
    </div>
</div>

</body>