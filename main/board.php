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

mysql_select_db($database_condb, $condb);
$query_Recordset1 = "SELECT ID, location, `date`, member, pname FROM party ORDER BY `date` ASC";
$Recordset1 = mysql_query($query_Recordset1, $condb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php include ('header.php'); ?>
<style type="text/css">
body{
    background: #3395ff;
    background-image: url("img/bg.png");
    background-repeat: repeat;
}
.container{
    margin-top: 5%;
    padding: 20px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 5px;
    margin-top: 5%;
    padding: 20px;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.44);
}
</style>
</head>
<?php include ('navbar-2.php'); ?>
<body>
<div class="container">
  <div class="row">
    <div class="col-1"></div>
    <div class="col-2" style="border-right:1px solid #9e9e9e96;"><a href="post.php" class="btn btn-success" role="button"><i class="fa fa-plus" aria-hidden="true"></i> New Party</a>
</br></br><div class="input-group">
  
  <div class=""></div></div></div>
<div class="col-8">
  <h2>All Party</h2>
  <table border="0">
  <tr>
    <td width="10%" align="center">Party ID</td>
    <td width="25%" align="center">Location</td>
    <td width="30%" align="center">Date/Time</td>
    <td width="35%" colspan="2" align="center">Party name</td>
    </tr>
  <?php do { ?>
    <tr>
      <td align="center"><a href="page.php?ID=<?php echo $row_Recordset1['ID']?>"><?php echo $row_Recordset1['ID']; ?></a></td>
      <td align="center"><?php echo $row_Recordset1['location']; ?></td>
      <td align="center"><?php echo $row_Recordset1['date']; ?></td>
      <td align="center">&nbsp;</td>
      <td align="center"><?php echo $row_Recordset1['pname']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</div>
<div class="col-1"></div>

  </div>
  
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
