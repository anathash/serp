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
                    const now = new Date();
                    const end_time = Math.round(now.getTime() / 1000);
                    $.cookie('end_time', end_time, {expires: 1});
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
                    <div class="col">
                        <h2 style="font-size:120%;">How much did the ad affect your search experience? </h2>
                        <h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1"
                                       value="option1" required>
                                <label class="form-check-label" for="radio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2"
                                       value="option2" required>
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                        </h3>
                    </div>
                    <hr>
                    <div class="col">
                        <h2 style="font-size:120%;">How much did the ad affect your search experience? </h2>
                        <h3>
                            <label for="customRange2" class="form-label">Affection range</label>
                            <input type="range" class="form-range" min="-3" max="3" id="range1"
                                   onInput="$('#rangeval1').html($(this).val())">
                            <span id="rangeval1">0</span>
                            <p>A score -3 means the ad had a very negative effect, a score of 0 means you were indifferent to add  and a score of +3 means it had a very positive effect</p>
                        </h3>
                    </div>
                    <hr>
                    <div class="col">
                        <h2 style="font-size:120%;">How much did the ad affect your decision regarding the treatment's
                            effectiveness?</h2>
                        <br>
                        <h3>
                            <label for="customRange2" class="form-label">Affection range</label>
                            <input type="range" class="form-range" min="-3" max="3" id="range2"
                                   onInput="$('#rangeval2').html($(this).val())">
                            <span id="rangeval2">0</span>
                            <p>A scale of 0 means it did not affect your decision at all and a score of +3 means it strengthened your belief in the treatment's effectiveness</p>
                        </h3>
                    </div>
                    <hr>
                    <button class="btn peach-gradient" type="submit">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

</body>