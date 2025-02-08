<!DOCTYPE html>
<html>
<head>
  <title>Company Login</title>
  <link rel="stylesheet" href="login.css">
  <link rel="icon" type="image/png" href="images/11.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="login-box">

  <a href="index.html"><i class="fa fa-arrow-circle-left" style="font-size:24px; color: white; position: relative; top: -35px;"></i></a>

  <img src="logo2.png" style="height: 58px; padding-left: 63px;" >
  <h2>Login</h2>

  <form action="login_verify.php" method="post">
    <div class="user-box">
      <input type="email" name="email" id="email" required="">
      <label>Email</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" id="password" required="">
      <label>Password</label>
    </div>

    <div class="user-box1">
      <input type="radio" id="company" name="role" value="company" checked>
      <label for="html" style="position: relative;top:-10px;">Company</label>
      <input type="radio" id="candidate" name="role" value="candidate">
      <label for="css" style="position: relative;top:-10px;">Candidate</label>
    </div>
    <button type="submit" class="b1" style="background-color: transparent; border: none;">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit
    </button>
  </form>
</div>

</body>
</html>
