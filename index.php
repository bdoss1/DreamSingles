<?php session_start(); ?>

<html>
  <head>
    <title>Dream Singles Quiz - Baron Doss</title>

  <style>
    body {
      background: #053C96;
    }

    img {
      float: left;
    }

    input[type=text], input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 6px 0 22px 0;
      display: block;
      border: 1px solid #000000;
      background: #F1F1F1;
      border-radius: 25px;
    }  

    input[type=text]:focus, input[type=password]:focus {
      width: 100%;
      padding: 15px;
      margin: 6px 0 22px 0;
      display: block;
      border: 1px solid #000000;
      background: #F1F1F1;
      border-radius: 25px;   
    }

    input[type=submit] {
      margin-top: 20px;
      padding: 5px 15px;
      background: #053C96;
      cursor: pointer;
      float: right;
      border: 1px solid #000000;
      border-radius: 25px;
      height: 30px;
      color: #ffffff; 
    }

    #registration {
      position: absolute;
      background: #FFF;
      padding: 20px;
      top: 55%;
      left: 50%;
      transform: translate(-50%, -50%);
      border: 1px solid #000000;
    }

    select {
      width: 32%;
      padding: 5px 15px;
      margin-top: 10px;
      background: #F1F1F1;
      border: 1px solid #000000;
      border-radius: 25px;
    }

    hr {
      border: 0;
      height: 1px;
      background: #333;
      background-image: linear-gradient(to right, #CCC, #333, #CCC);
    }

    .success {
        color: #33CCFF;
    }

    .error {
        color: #FF0000;
    }
    
  </style>

  </head>
  
  <body>
    <img src="https://www.dream-singles.com/images/ds-logo-reward.png" />
    <div id="registration">
    <form action="register.php" method="POST">
      <div class="title">
        <h2>New User Registration</h2>
      </div>
      <div class="<?php echo $_SESSION["message"]["response"]; ?>">
        <?php echo $_SESSION["message"]["value"]; ?>
      </div>
      
      <hr />

      <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter Email" required />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter Password" 
          pattern="(?=.*\d)(?=.*[a-z]).{8,}" 
          title="Must contain both numbers and characters, and at least 8 or more characters" required />
        <label for="password2">Reenter Password</label>
        <input type="password" name="password2" id="password2" placeholder="Reenter Password" required />
      </div>

<!-- I really really really want to write a function here to return the dropdown values 
but for the sake of time we have hard coded (UGH) values - BD -->

      <label for="bday">Birthday</label>
      <div class="bday" id="bday" required>
        <select name="month">
          <option value="">Select Month</option>
          <option value="01">January</option>
          <option value="02">February</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">August</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        <select name="day" required>
          <option value="">Select Day</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>

<!-- Also for the sake of time we are only displaying 2 years. 
    One older than 18 and One younger -->
        <select name="year" required>
          <option value="">Select Year</option>
          <option value="2000">2000</option>
          <option value="2004">2004</option>
        </select>
      </div>
        
      <div class="submit">
        <input type="submit" value="Register">
      </div>

    </form>

    </div>

    </body>
</html>
<?php session_destroy(); ?>
