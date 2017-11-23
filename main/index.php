<?php require_once('../Connections/condb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "board.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_condb, $condb);
  
  $LoginRS__query=sprintf("SELECT email, pass FROM userid WHERE email=%s AND pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $condb) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php include ('header.php'); ?>
<style type="text/css">
body{
    background: #3395ff;
    background-image: url("img/bg.png");
    background-repeat: repeat;
}
.container{
    background: rgba(255, 255, 255, 0.8);
    border-radius: 5px;
    margin-top: 9.5%;
    padding: 20px;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.44);
}
</style>
</head>
<?php include ('navbar-1.php'); ?>
<body>

      <div class="container">

<h2 style="text-align: center;color:#000;">LOG IN</h2>
<hr>
<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="login" id="login" style="color:#000;">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input name="email" type="email" class="form-control" id="email" placeholder="Email Address">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input name="pass" type="password" class="form-control" id="pass" placeholder="Password">
  </div>
</br>
  <button type="submit" class="btn btn-outline-primary" style="width: 76%;">Login</button>
  <a href="signup.php" class="btn btn-outline-danger" role="button" style="width: 23%;">Sign up</a>
</form>

</div>


<script src="../vendor/bootstrap/js/jquery.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>