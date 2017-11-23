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
  $insertSQL = sprintf("INSERT INTO party (location, `date`, detail, pname) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['detail'], "text"),
                       GetSQLValueString($_POST['pname'], "text"));

  mysql_select_db($database_condb, $condb);
  $Result1 = mysql_query($insertSQL, $condb) or die(mysql_error());

  $insertGoTo = "board.php";
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
    margin-top: 5%;
    padding: 20px;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.44);
    width: 50%;
}
</style>
</head>
<?php include ('navbar-2.php'); ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-2"><a href="board.php" class="btn btn-success" role="button"><i class="fa fa-backward" aria-hidden="true"></i> board</a></div>
        <div class="col-10">
    <h3 style="text-align: right;color:#000;">Make the new party ... </h3><hr>
    </div>
    <div class="col-2"></div>
</div>
<div class="row">
<div class="col-1"></div>
<div class="col-3">
  </br>
<label for="name"><i class="fa fa-hashtag" aria-hidden="true"></i> Party name</label></br></br>
<label for="location"><i class="fa fa-location-arrow" aria-hidden="true"></i> Location</label></br></br>
<label for="date-time"><i class="fa fa-calendar" aria-hidden="true"></i> Date / Time</label></br></br>
<label for="detail"><i class="fa fa-commenting" aria-hidden="true"></i> Detail</label>
</div>
<div class="col-1">
  </br>
<label>:</label></br></br>
<label>:</label></br></br>
<label>:</label></br></br>
<label>:</label>
</div>
<div class="col-6">
  </br>
  <form method="POST" action="<?php echo $editFormAction; ?>" name="form">
    <div class="form-group">
      <input name="pname" type="text" class="form-control" id="pname"></br>
      <input name="location" type="text" class="form-control" id="location"></br>
      <input name="date" type="datetime-local" class="form-control" id="date"></br>
      <textarea name="detail" rows="5" class="form-control" id="detail"></textarea>
  </br>
      <button type="submit" class="btn btn-outline-dark" style="width:100%;">Submit</button>
    </div>
    <input type="hidden" name="MM_insert" value="form">
  </form>
  
</div>
<div class="col-1"></div>
</div>  
</div>
</body>
</html>