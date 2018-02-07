<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Service Unavailable</title>

	<!-- Bootstrap CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	<style>
		html, body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			height: 100vh;
			margin: 0;
		}

		.error-template {
			padding: 40px 15px;
			text-align: center;
		}

		.error-actions {
			margin-top: 15px;
			margin-bottom: 15px;
		}

		.error-actions .btn {
			margin-right: 10px;
		}

		h1 {
			font-size: 84px;
		}

		h2 {
			color: #808080; text-decoration: none;			
		}
		.vertical-align {
			min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
			min-height: 100vh; /* These two lines are counted as one :-)       */

			display: flex;
			align-items: center;
		}
	</style>

</head>

<body>
	
	@yield('body')

	<!-- jQuery -->
	<script src="/js/jquery.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="/js/bootstrap.min.js"></script>
</body>

</html>