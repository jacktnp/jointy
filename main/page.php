<?php require_once('../Connections/condb.php'); ?>
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

if ((isset($_GET["MM_insert"])) && ($_GET["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO ``data`` (sname) VALUES (%s)",
                       GetSQLValueString($_GET['IDN'], "text"));

  mysql_select_db($database_condb, $condb);
  $Result1 = mysql_query($insertSQL, $condb) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_condb, $condb);
$query_Recordset1 = sprintf("SELECT * FROM party WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $condb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset2 = $_SESSION['user'];
}
mysql_select_db($database_condb, $condb);
$query_Recordset2 = sprintf("SELECT * FROM userid WHERE `user` = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $condb) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_condb, $condb);
$query_Recordset3 = "SELECT * FROM `data`";
$Recordset3 = mysql_query($query_Recordset3, $condb) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
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
p{
  font-size: 1.2em;
}
</style>
</head>
<?php include ('navbar-2.php'); ?>
<?php '$pname = '.$_GET['search'].''; ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-2">
          <a href="board.php" class="btn btn-success" role="button"><i class="fa fa-backward" aria-hidden="true"></i> board</a>
        </div>
        <form name="form1" method="post" action="page.php" class="form-inline">
          <label>ID Party :</label>&nbsp;
      <input type="text" class="form-control" name="ID" id="ID" placeholder="ใส่รหัสเพื่อดูรายละเอียด (ดูได้จากหน้า board)" style="width:auto;">&nbsp;
      <input type="submit" name="bsearch" id="bsearch" value="Search" class="btn btn-outline-info">
    </form>
    </div>
    <hr>
<div class="row">
  <div class="col-1"></div>
<div class="col-3">
  </br>
  <p><i class="fa fa-address-book" aria-hidden="true"></i> Party name</p>
      </br>
      <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Location</p>
      </br>
      <p><i class="fa fa-calendar" aria-hidden="true"></i> Date / Time</p>
      </br>
      <p><i class="fa fa-commenting" aria-hidden="true"></i> Detail</p>
</div>
<div class="col-1">
  </br>
  <p>:</p></br>
  <p>:</p></br>
  <p>:</p></br>
  <p>:</p>
</div>
<div class="col-6">
  </br>
      <p><?php echo $row_Recordset1['pname']; ?></p>
      </br>
      <p><?php echo $row_Recordset1['location']; ?></p>
      </br>
      <p><?php echo $row_Recordset1['date']; ?></p>
      </br>
      <p><?php echo $row_Recordset1['detail']; ?></p>
</div>
<div class="col-1"></div>
</div>
</br>
<hr>
</br>
<center>
 <form method="POST" action="" name="form" class="form-inline" style="align-content: center;">
            <label>สนใจเข้าร่วม :</label>&nbsp;&nbsp;
            <input type="text" name="IDN" id="IDN" class="form-control" placeholder="ลงชื่อเพื่อเข้าร่วม">&nbsp;
            <button type="submit" class="btn btn-outline-success" style="height: auto;width: auto;" onclick="success_function()"><i class="fa fa-check" aria-hidden="true"></i> JOIN</button>
  </form>
</center>
</div>
<script>
function success_function() {
  alert("ลงชื่อสำเร็จ");
}
</script>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
