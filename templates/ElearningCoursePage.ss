<!DOCTYPE html>
<!--[if IE 8]><html class="lt-ie9" lang="eng"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<% base_tag %>
	<meta charset="utf-8">
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width">
	<title>$Title | $Course.Title | The University of Iowa</title>
	<% include Icons %>
	<link rel="stylesheet" type="text/css" href="division-elearning-project/css/app.css" />

	<!--[if lt IE 9]>
		<script src="{$ThemeDir}/vendor/html5shiv/dist/html5shiv.js"></script>
		<script src="{$ThemeDir}/vendor/respond/dest/respond.min.js"></script>
	<![endif]-->

</head>

<body class="$ClassName">
	<% include DivisionBar %>

	<div class="gradient">
	    <div class="container">
	    	<div class="row">
	    		$Layout
	    	</div>
	   	</div>
	</div>
    
   	<% include Footer %>
    <script type="text/javascript" src="division-elearning-project/build/app.min.js"></script>
	<% include GoogleAnalytics %>
</body>
</html>