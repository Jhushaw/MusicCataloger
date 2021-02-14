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
         background-image: url("https://images.pexels.com/photos/326311/pexels-photo-326311.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
         background-repeat: no-repeat;
         background-size: cover;
         }
         
    .container {
    border-radius: 25px;
    background: white;
    border: 2px solid black;
    padding: 50px;
    width: 40%;
    height: 90%;
    }
    
    .containerfull {
    border-radius: 25px;
    background: white;
    border: 2px solid black;
    padding: 50px;
    width: 90%;
    height: 100%;
    }
    
    .footer{
    position: fixed;
    left: 0;
    bottom: 0;
    background:white;
    height:5%;
    width:100%;
    }
    
    .table-fixed tbody {
    height: 500px;
    overflow-y: scroll;
    width: 100%;
}

.table-fixed thead,
.table-fixed tbody,
.table-fixed tr,
.table-fixed td,
.table-fixed th {
    display: block;
}

.table-fixed tbody td,
.table-fixed tbody th,
.table-fixed thead > tr > th {
    float: left;
    position: relative;
}

.table-fixed tr::after {
        content: '';
        clear: both;
        display: block;
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