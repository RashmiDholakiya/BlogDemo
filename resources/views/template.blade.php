<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

     <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <link rel="stylesheet" href= "{!! asset('resources/assets/demo.css') !!}" >
    <link rel="stylesheet" href= "{!! asset('resources/assets/css/bootstrap.min.css') !!}" >
    <link rel="stylesheet" href= "{!! asset('resources/assets/css/bootstrap.css') !!}" >
    <link rel="stylesheet" href= "{!! asset('resources/assets/header-basic.css') !!}" >
    <link rel="stylesheet" href= "{!! asset('resources/assets/css/style.css') !!}" >
    <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        .error
        {
            color: red;
        }
    </style>
    <script>
        $.noConflict();
    </script>
    <script type="text/javascript" src="{!! asset('resources/assets/js/script.js') !!}"></script>
    <header class="header-basic">

        <div class="header-limiter">

            <h1><a href="{!! url('home') !!}">Blog<span>System</span></a></h1>


            <nav id="nav" >

                @yield('nav')


            </nav>


        </div>
    </header>

</head>

<body>
<div class="container">
@yield('content')
</div>

</body>



</html>