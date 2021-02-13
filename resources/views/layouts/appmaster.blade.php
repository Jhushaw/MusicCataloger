<html lang = "en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="stylesheet" href="resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="resources/assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    
    <style>
    body {
         background-image: url("https://venngage-wordpress.s3.amazonaws.com/uploads/2018/09/Colorful-Circle-Simple-Background-Image-1.jpg");
         background-repeat: no-repeat;
         background-size: cover;
         }
         
    .container {
    border-radius: 25px;
    background: white;
    border: 2px solid black;
    padding: 50px;
    width: 40%;
    height: 80%;
    }
        .containerfull {
    border-radius: 25px;
    background: white;
    border: 2px solid black;
    padding: 50px;
    width: 90%;
    height: 80%;
    }
    
    .footer{
    background:white;
    height:5%;
    width:100%;
    }
    </style>
</head>
	
<body>
	@include('layouts.header')
	<div align="center">
	@yield('content')
	</div>
	@include('layouts.footer')
</body>
</html>