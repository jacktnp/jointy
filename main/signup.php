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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO userid (`user`, pass, email) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['pass'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_condb, $condb);
  $Result1 = mysql_query($insertSQL, $condb) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
    width: 45%;
}
</style>
</head>
<?php include ('navbar-1.php'); ?>
<body>
<div class="container">
    <form action="<?php echo $editFormAction; ?>" method="post" name="form" class="form-horizontal" id="form" role="form">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <h2 style="text-align: center;color:#000;">SIGN UP</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name" style="color:#000;">Name</label>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text" name="user" class="form-control" id="user"
                               placeholder="First Last" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put name validation error messages here -->
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email"  style="color:#000;">E-Mail Address</label>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <input type="text" name="email" class="form-control" id="email"
                               placeholder="em@il.com" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put e-mail validation error messages here -->
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password" style="color:#000;">Password</label>
            </div>
            <div class="col-md-8">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="pass" class="form-control" id="pass"
                               placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-control-feedback">
                        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                
            </div>
            <div class="col-md-8">
                <div class="form-group"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <button type="submit" class="btn btn-outline-success" style="width:70%;"><i class="fa fa-user-plus"></i>  Sign Up</button>
				<a href="index.php" class="btn btn-outline-warning" role="button" style="width: 28.5%;">Login</a>
            </div>
        </div>
      <input type="hidden" name="MM_insert" value="form">
    </form>
</div>
<script src="../vendor/bootstrap/js/jquery.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>