<html lang="en">
<head>
    <title>SERP</title>
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
<script>
    function no() {
		$.cookie("knowledge", "no", { expires : 1 });
        window.location.href = $.cookie('url');
    }

    function yes() {
		$.cookie("knowledge", "yes", { expires : 1 });
        window.location.href = $.cookie('url');
    }
</script>
<br>
<div class="login-box">
    <div class="container">
        <div class="jumbotron cloudy-knoxville-gradient">
            <div class="container">
                <h4> Thanks for agreeing to participate in our research survey!
				<br>
				<br>
				In the next page you will be presented with search results for the query: is <span style="color: #3875d7"
                            ><?php echo $_COOKIE['topic1']; ?></span> an effective treatment for <span style="color: #993333"
                            ><?php echo $_COOKIE['topic0']; ?></span>.
				<br>
				<br>		
				Your task is to determine the answer to this query, <u>in the context of the presented results only.</u>
				<br>
				<br>
				
				Use the links in the next page (click at least one) to find the required answer. When you are ready, click the “Answer Survey” button.
				<br>
				<br>
				You will then be directed to a form to insert your answer.
				You will also be required to shortly explain what is  <span style="color: #3875d7"
                            ><?php echo $_COOKIE['topic1']; ?></span>, what is <span style="color: #993333"
                            ><?php echo $_COOKIE['topic0']; ?></span>
				and why you chose the answer you did. 
				<br>
				<br>
				<span style="color: #FF0000">Bonus Plan:</span>
				Our system will record your search behavior for academic research purposes. 
				 <br>
				 If our data will show that your answers were qualified by the results presented to you and your search actions, you will receive a bonus of <span style="color: #FF0000">1$.</span>
                <br>
				</h4>
                <br>
                <p>Before proceeding to the next page, please answer this question:</p>
                <h3>Do you have pre-existing knowledge regarding above treatment? </h3>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn tempting-azure-gradient" onclick="yes()">Yes, I do</button>
                </div>
                <div class="col">
                    <button class="btn peach-gradient" onclick="no()">Not a lot</button>
                </div>
                <div class="col">
                    <button class="btn young-passion-gradient" onclick="no()">None</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>