<!DOCTYPE html>
<html>
<head>
	<title>Redirect</title>
	<style type="text/css">

		img {
			position: fixed;
			top: 10%;
			padding-left: 35%;	
			padding-right: 35%;	
			width: 30%;
			height: auto;
		}

	</style>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jqueryrotate.min.js"></script>
</head>
<body>

	<img class="logo" id="border" src="images/border.png">
	<img class="logo" src="images/frame.png">

	<script type="text/javascript">
		var startRotation = function (){
		  $("#border").rotate({
		    angle:0,
		    animateTo:24,
		    callback: startRotation,
		    easing: function (x,t,b,c,d) {
		      return c*(t/d)+b;
		    }
		  });
		}
		startRotation();
	</script>
	
</body>
</html>