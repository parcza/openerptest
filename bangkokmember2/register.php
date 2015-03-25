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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO contact (membercard_no, HN, title, name, surname, idcardno, phone, address, province, country, zipcode, birthday, email, `class`, career) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['membercard_no'], "int"),
                       GetSQLValueString($_POST['HN'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['idcardno'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['province'], "text"),
                       GetSQLValueString($_POST['country'], "text"),
                       GetSQLValueString($_POST['zipcode'], "int"),
                       GetSQLValueString($_POST['birthday'], "date"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['class'], "int"),
                       GetSQLValueString($_POST['career'], "text"));

  mysql_select_db($database_bangkokmember, $bangkokmember);
  $Result1 = mysql_query($insertSQL, $bangkokmember) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO register (register_empid, regiser_chanelid, register_branchid, register_membercardno) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['register_empid'], "int"),
                       GetSQLValueString($_POST['register_chanelid'], "int"),
                       GetSQLValueString($_POST['register_branchid'], "int"),
                       GetSQLValueString($_POST['register_membercardno'], "int"));

  mysql_select_db($database_bangkokmember, $bangkokmember);
  $Result1 = mysql_query($insertSQL, $bangkokmember) or die(mysql_error());

  $insertGoTo = "index.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_bangkokmember, $bangkokmember);
$query_set_contact = "SELECT * FROM contact";
$set_contact = mysql_query($query_set_contact, $bangkokmember) or die(mysql_error());
$row_set_contact = mysql_fetch_assoc($set_contact);
$totalRows_set_contact = mysql_num_rows($set_contact);

mysql_select_db($database_bangkokmember, $bangkokmember);
$query_set_branch = "SELECT * FROM branch";
$set_branch = mysql_query($query_set_branch, $bangkokmember) or die(mysql_error());
$row_set_branch = mysql_fetch_assoc($set_branch);
$totalRows_set_branch = mysql_num_rows($set_branch);

mysql_select_db($database_bangkokmember, $bangkokmember);
$query_set_chanel = "SELECT * FROM chanel";
$set_chanel = mysql_query($query_set_chanel, $bangkokmember) or die(mysql_error());
$row_set_chanel = mysql_fetch_assoc($set_chanel);
$totalRows_set_chanel = mysql_num_rows($set_chanel);

mysql_select_db($database_bangkokmember, $bangkokmember);
$query_set_emp = "SELECT * FROM employee";
$set_emp = mysql_query($query_set_emp, $bangkokmember) or die(mysql_error());
$row_set_emp = mysql_fetch_assoc($set_emp);
$totalRows_set_emp = mysql_num_rows($set_emp);

mysql_select_db($database_bangkokmember, $bangkokmember);
$query_set_register = "SELECT * FROM register";
$set_register = mysql_query($query_set_register, $bangkokmember) or die(mysql_error());
$row_set_register = mysql_fetch_assoc($set_register);
$totalRows_set_register = mysql_num_rows($set_register);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Member &gt; Register</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color:#414958;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this container surrounds all other divs giving them their percentage-based width ~~ */
.container {
	width: 80%;
	max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 780px;/* a min-width may be desirable to keep this layout from getting too narrow. This keeps line length more readable in the side columns. IE6 does not respect this declaration. */
	background-color: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
}

/* ~~the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo~~ */
.header {
	background-color: #333333;
	color: #FFF;
}

/* ~~ This is the layout information. ~~ 

1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

*/
.content {
	padding: 10px 0;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background-color: #6F7D94;
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>

<div class="container">
  <div class="header">MEMBER &gt; REGISTER <!-- end .header --></div>
  <div class="content">
    <form method="POST" action="<?php echo $editFormAction; ?>" name="form">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">เลขที่บัตรสมาชิก (10 หลัก)  :</td>
          <td><input type="text" name="membercard_no" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">HN:</td>
          <td><input type="text" name="HN" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">คำนำหน้าชื่อ:</td>
          <td><input type="text" name="title" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ชื่อจริง:</td>
          <td><input type="text" name="name" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">นามสกุล:</td>
          <td><input type="text" name="surname" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">เลขที่บัตรประชาชน:</td>
          <td><input type="text" name="idcardno" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">เบอร์โทร:</td>
          <td><input type="text" name="phone" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ที่อยู่:</td>
          <td><input type="text" name="address" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">จังหวัด:</td>
          <td><input type="text" name="province" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ประเทศ:</td>
          <td><input type="text" name="country" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Zipcode:</td>
          <td><input type="text" name="zipcode" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">วันเกิด:</td>
          <td><input type="text" name="birthday" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">อีเมล์:</td>
          <td><input type="text" name="email" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ประเภทบัญชี:</td>
          <td><input type="text" name="class" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">อาชีพ:</td>
          <td><input type="text" name="career" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ศูนย์บริการ:</td>
          <td><select name="register_branchid" id="register_branchid">
            <?php
do {  
?>
            <option value="<?php echo $row_set_branch['branch_id']?>"><?php echo $row_set_branch['branch_major']?></option>
            <?php
} while ($row_set_branch = mysql_fetch_assoc($set_branch));
  $rows = mysql_num_rows($set_branch);
  if($rows > 0) {
      mysql_data_seek($set_branch, 0);
	  $row_set_branch = mysql_fetch_assoc($set_branch);
  }
?>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ประเภทบัตรสมาชิก:</td>
          <td><select name="register_chanelid" id="register_chanelid">
            <?php
do {  
?>
            <option value="<?php echo $row_set_chanel['chanel_id']?>"><?php echo $row_set_chanel['chanel_name']?></option>
            <?php
} while ($row_set_chanel = mysql_fetch_assoc($set_chanel));
  $rows = mysql_num_rows($set_chanel);
  if($rows > 0) {
      mysql_data_seek($set_chanel, 0);
	  $row_set_chanel = mysql_fetch_assoc($set_chanel);
  }
?>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">เจ้าหน้าที่:</td>
          <td><select name="register_empid" id="register_empid">
            <?php
do {  
?>
            <option value="<?php echo $row_set_emp['emp_id']?>"><?php echo $row_set_emp['emp_name']?></option>
            <?php
} while ($row_set_emp = mysql_fetch_assoc($set_emp));
  $rows = mysql_num_rows($set_emp);
  if($rows > 0) {
      mysql_data_seek($set_emp, 0);
	  $row_set_emp = mysql_fetch_assoc($set_emp);
  }
?>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">ยืนยันเลขที่บัตรสมาชิก:</td>
          <td><input type="text" name="register_membercardno" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input name="Submit" type="submit" value="Submit"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form">
    </form>
    <h1>&nbsp;</h1>
  </div>
  <div class="footer">    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($set_contact);

mysql_free_result($set_branch);

mysql_free_result($set_chanel);

mysql_free_result($set_emp);

mysql_free_result($set_register);
?>
