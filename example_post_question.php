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


</style>
<body>
<br>
<div class="login-box">
    <div class="container">
        <div class="jumbotron cloudy-knoxville-gradient">
			<script>
					var tries = 0;
					function validateFormSubmit() {
						var q11 = document.getElementById("q1a1").checked;
						var q12 = document.getElementById("q1a2").checked;
						var q13 = document.getElementById("q1a3").checked;
						var q21 = document.getElementById("q2a1").checked;
						var q22 = document.getElementById("q2a2").checked;
						var q23 = document.getElementById("q2a3").checked;
						var fa = document.getElementById("feedback").value === "Y";
						var f = document.getElementById("feedback").value === "";
						if ((!q11 && !q12 && !q13) || (!q21 && !q22 && !q23) || f){
							alert("Please answer the all the questions");
							return false;
						}
						if (q13 && q22 && fa) {
							window.location.href = "continue.php";
							return;
						}
						
						tries = tries +1;
						
						if (tries > 2) {
							window.location.href = "goodby.php"; //TODO - add users to blocked users
							return;
						}
						
						alert("Those are not the correct answers, please try again");
					}
			</script>
            <div class="row">
                <h4>  Please answer the following questions. 
                </h4>
				<br>
            </div>
            <div>
                <!--form action='knowledge.php' method='post' onsubmit="return validateFormSubmit();">-->
					<div class="row">
								<p style="font-size:120%;">What are <span style="color: #3875d7" ></span> ?
								<br>

								<input type="radio" name="treatment_q" id ="q1a1" value="antibiotics" >
								<label for="q1a1">A group of antibiotic medications.</label><br>
								
								<input type="radio" name="treatment_q" id ="q1a2" value="herb ">
								<label for="q1a2">A herb that helps sleep disorders.</label><br>
								
								<input type="radio" name="treatment_q" id ="q1a3" value="sedative">
								<label for="q1a3">A sedative perscribed by doctors. </label><br>
								</p>
					</div>
								<div class="row">
								<p style="font-size:120%;">What is  <span style="color: #993333"> delirium tremens </span>?
								<br>							
								<input type="radio" name="condition_q" id ="q2a1" value="mental" >
								<label for="q2a1">A mental health condition</label><br>
								
								<input type="radio" name="condition_q" id ="q2a2" value="alcohol">
								<label for="q2a2">A symptom of acute alcohol withdrawal</label><br>
								
								<input type="radio" name="condition_q" id ="q2a3" value="brain">
								<label for="q2a3">A brain disorder that leads to shaking</label><br>
								</p>

					</div>

                    <div class="row">
                        
							<p style="font-size:120%;">According to the information you read, are <span style="color: #3875d7"
							>benzodiazepines </span> effective in treating delirium tremens<span style="color: #993333"> </span>?
						  </p>

                            <i class="fas fa-lock"></i>
                            <select id="feedback" name="feedback" REQUIRED>
                                <option value="" disabled selected>Please select your answer</option>
                                <option value="N">No- According to the information I read it is not effective</option>
                                <option value="Y">Yes - According to the information I read it is effective</option>
                                <option value="M">Maybe - According to the information I read it is inconclusive whether or not it is effective</option>
                                <option value="NS">Not sure, there was not enough information for me to reach a conclusion.</option>
                            </select>
                    </div>					
						<button class="btn peach-gradient" type="button" onclick="validateFormSubmit()">Submit</button>                    
                <!--</form>-->
            </div>

        </div>
    </div>
</div>

</body>