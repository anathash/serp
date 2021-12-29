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
					function validateFormSubmit() {
						var o1 = document.getElementById("hormone").checked;
						var o2 = document.getElementById("nutrients").checked;
						var o3 = document.getElementById("tree").checked;
						if (!o1 && !o2 && !o3) {
							alert("Please answer the all the questions");
							return false;
						}
						var o4 = document.getElementById("neurological").checked;
						var o5 = document.getElementById("ringing").checked;
						var o6 = document.getElementById("sleep").checked;
						if (!o4 && !o5 && !o6) {
							alert("Please answer the all the questions");
							return false;
						}
						const now = new Date();
						const end_time = Math.round(now.getTime() / 1000) ;
						$.cookie('end_time', end_time, { expires : 1 });
						return true;
					}
			</script>
            <div class="row">
                <h4> Thank you for returning. Please answer the following questions to complete the survey. 
                </h4>
				<br>
            </div>
            <div>
                <form action='experiment_redirect.php' method='post' onsubmit="return validateFormSubmit();">
					<div class="row">
								<p style="font-size:120%;">What is /are  <span style="color: #3875d7" ><?php echo $_COOKIE['topic1']; ?></span> ?
								<br>

								<input type="radio" name="treatment" id ="hormone" value="hormone" >
								<label for="hormone">A hormone.</label><br>
								
								<input type="radio" name="treatment" id ="nutrients" value="nutrients ">
								<label for="nutrients">A nutrient found mostly in fish, nuts and seeds.</label><br>
								
								<input type="radio" name="treatment" id ="tree" value="tree">
								<label for="tree">A tree.</label><br>
								</p>
					</div>
								<div class="row">
								<p style="font-size:120%;">What is  <span style="color: #993333"><?php echo $_COOKIE['topic0']; ?></span>?
								<br>							
								<input type="radio" name="condition" id ="neurological" value="neurological" >
								<label for="neurological">A neurological disorder.</label><br>
								
								<input type="radio" name="condition" id ="ringing" value="ringing">
								<label for="ringing">Ringing noise in one or both ears.</label><br>
								
								<input type="radio" name="condition" id ="sleep" value="sleep">
								<label for="sleep">A sleep problem.</label><br>
								</p>

					</div>

                    <div class="row">
                        
							<p style="font-size:120%;">According to the information you read, is/are <span style="color: #3875d7"
							><?php echo $_COOKIE['topic1']; ?></span> effective in treating <span style="color: #993333"
							><?php echo $_COOKIE['topic0']; ?></span>?
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
					
					<div class = "row">
						<p style="font-size:120%;"> Please write in a few words, what made you select your answer:</p>
						<br>
						<input type="text" id="reason" name="reason"  size="80" required><br><br>  
					</div>
					<div class = "row">
						<p style="font-size:120%;"> Add here any comments you would like to pass to the survey operators:</p>
						<br>
						<input type="text" id="comments" name="comments"  size="80"><br><br>  
					</div>
						<button class="btn peach-gradient" type="submit">Submit</button>                    
                </form>
            </div>

        </div>
    </div>
</div>

</body>