<!doctype html> 
<html>
<head>
<meta charset="utf-8">
<title>BANGKOK CLINIC TM - MEMBER</title>
<link href="jquery-mobile/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/">
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
	  <div data-role="fieldcontain">
          <label for="membercard_no">เลขที่บัตรสมาชิก:</label><input name="membercard_no" type="text" class="ui-icon-searchfield" id="textinput"/><button>Button</button></div><hr>

	  <div class="ui-grid-a">
	    <div class="ui-block-a">Block 1,1</div>
	    <div class="ui-block-b">Block 1,2</div>
	    <div class="ui-block-a">Block 2,1</div>
	    <div class="ui-block-b">Block 2,2</div>
	    <div class="ui-block-a">Block 3,1</div>
	    <div class="ui-block-b">Block 3,2</div>
      </div>
          
	</form>
	</div>
  <div data-role="footer">
   <h4>Page Footer</h4></div>
</div>

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

</body>
</html>