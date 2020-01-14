<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Reportes</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 ">
            <img width= "30%" class="img-fluid" src="vendors/img/logo.png">  
        </div>
    </div>
    <br>
    <hr>

    @yield('content')
</div>

<footer style="   position:fixed;
left:0px;
bottom:0px;
height:30px;
width:100%;
">@yield('footer')</footer>
</body>
</html>