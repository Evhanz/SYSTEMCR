<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
</head>
<body>

<div id="cabecera">
<h3 id="mensaje">
Institución Educativa Cristo Rey
<img id="imgCabecera" src="{{ asset('imagenes/adds/logo.png') }}" alt=""/>
</h3>
</div>
<hr/>
<div class="container">
    <div class="row">
     @yield('content')
    </div>
</div>



</body>
</html>

<style>

    body{
        margin: -20px;
        padding: -10px;
        font-family: arial;
    }
    #cabecera{

        color: lightslategrey;
        font-family: Montserrat;
        margin-top: -30px;
        padding-bottom: -20px;
        text-align: right;
        opacity: 0.4;
        filter: alpha(opacity=40)
        


    }

    #imgCabecera{
        width: 40px;
        opacity: 0.4;
        filter: alpha(opacity=40)

    }


    hr {
        border-top: 3px solid lightslategrey;
        border-bottom: 2px dashed lightslategrey;
        border-left:none;
        border-right:none;
        height: 6px;
        opacity: 0.4;
        filter: alpha(opacity=40)

    }


</style>