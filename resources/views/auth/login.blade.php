
<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="/lumino/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/lumino/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/lumino/css/login_styles.css">
	<link rel="stylesheet" type="text/css" href="/lumino/css/font-awesome.min.css">
<head>
	<title> Ramal Virtual </title>
</head>
<body>
	<div id="content"></div>
	<script type="text/javascript" src="/third_party/jquery/jquery.js"></script>
	<script type="text/javascript" src="/lumino/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/login.js"></script>
	<script type="text/javascript">
		_ROUTES_ = {
			auth : {
				signup : "{{route('auth.signup')}}",
				signin : "{{route('auth.signin')}}"
			}
		}
	</script>
</body>
</html>
