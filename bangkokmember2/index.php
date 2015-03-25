<?php require_once('Connections/bangkokmember.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_POST['membercard_no'])) {
  $colname_Recordset1 = $_POST['membercard_no'];
}
mysql_select_db($database_bangkokmember, $bangkokmember);
$query_Recordset1 = sprintf("SELECT membercard_no FROM contact WHERE membercard_no = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $bangkokmember) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$colname_Recordset1 = "-1";
if (isset($_GET['membercard_no'])) {
  $colname_Recordset1 = $_GET['membercard_no'];
}
mysql_select_db($database_bangkokmember, $bangkokmember);
$query_Recordset1 = sprintf("SELECT membercard_no, HN, title, name, surname, idcardno, phone, address, province, country, zipcode, birthday, email, `class`, career FROM contact WHERE membercard_no = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $bangkokmember) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['membercard_no'])) {
  $colname_Recordset2 = $_GET['membercard_no'];
}
mysql_select_db($database_bangkokmember, $bangkokmember);
$query_Recordset2 = sprintf("SELECT * FROM tranaction WHERE membercard_no = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $bangkokmember) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!doctype html> 
<html>
<head>
<meta charset="utf-8">
<title>BANGKOK CLINIC TM - MEMBER</title>
<link href="jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/">
<style type="text/css">
body,td,th {
	color: #000;
}
</style>
<script src="jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body> 

<div data-role="page" id="page">
	<div data-role="header">
		<h1>BAGNK CLINIC TM - MEMBER</h1>
	</div>
	<div data-role="content">	
		<ul data-role="listview">
			<li><a href=register.php>REGISTER</a></li>
            <li><a href="#page2">MEMBER </a></li
			><li><a href="#page4">ADMIN</a></li>
		</ul>		
	</div>
	<div data-role="footer">
		<h5>PROJECT BY WORAPHONG SAIJHAIJERATRAGOON</h5>
	</div>
</div>

<div data-role="page" id="page2">
	<div data-role="header">
		<h1>MEMBER</h1>
	</div>
	<div data-role="content">
	<form action="" name="form1" target="_parent">
	  <div data-role="fieldcontain"><label for="membercard_no">เลขที่บัตรสมาชิก:</label><br><input name="membercard_no" type="text" class="ui-input-text" id="textinput"/>
      <button>Button</button></div>
	  <div class="ui-grid-a">
	    <div class="ui-block-a"><?php echo htmlentities($row_Recordset1['membercard_no']); ?></div>
	    <br>
	    <hr>

	    <div class="ui-grid-b">
	      <div class="ui-block-a"><?php echo htmlentities($row_Recordset1['title']); ?></div>
	      <div class="ui-block-b"><?php echo htmlentities($row_Recordset1['name']); ?></div>
	      <div class="ui-block-c"><?php echo htmlentities($row_Recordset1['surname']); ?></div>
        </div>
	  </div>   
	    <div data-role="collapsible-set">
	    <div data-role="collapsible">
	      <h3>ข้อมูลแต้มสะสม</h3>
	      <p>
	      <table width="100%" border="0" align="center">
	        <tr bgcolor="#CCCCCC">
	          <th width="20%">id</th>
	          <th width="26%">เลขที่บิล</th>
	          <th width="33%">มูลค่าสุทธิ</th>
	          <th width="21%">แต้มสะสม (PV)</th>
            </tr>
	        <?php do { ?>
	          <tr>
	            <td align="left" valign="baseline"><?php echo $row_Recordset2['id']; ?></td>
	            <td align="center" valign="baseline"><?php echo $row_Recordset2['bill_ref']; ?></td>
	            <td align="right" valign="baseline"><?php echo $row_Recordset2['bill_amount']; ?></td>
	            <td align="right" valign="baseline"><?php echo $row_Recordset2['pv']; ?></td>
            </tr>
	          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
          </table>
<p>
        </div>
	    <div data-role="collapsible" data-collapsed="true">
	      <h3>ข้อมูลการลงทะเบียน</h3>
	      <p>Content</p>
        </div>
	    <div data-role="collapsible" data-collapsed="true">
	      <h3>สิทธิพิเศษ</h3>
	      <p>Content</p>
        </div>
      </div>
	  </p>


<div data-role="page" id="page3">
	<div data-role="header">
		<h1>Admin</h1>
	</div>
	<div data-role="content">	
		Content		
	</div>
	<div data-role="footer">
		<h4>Page Footer</h4>
	</div>
</div>

<div data-role="page" id="page4">
	<div data-role="header">
		<h1>ADMINISTRATOR</h1>
	<div data-role="content">	
		Content		
	</div>
	<div data-role="footer">
		<h4>Page Footer</h4>
	</div>
</div>
	</form>
	</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
