<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- use stylesheet from sass -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
<div class="flex-center position-ref full-height">

    @if (Route::has('login') && Auth::check())
        <div class="top-right links">
            <a href="{{ url('/home') }}">Dashboard</a>
        </div>
    @elseif (Route::has('login') && !Auth::check())
        <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
    @endif

    <div class="content">
        <div class="wrapper">
            <div class="title m-b-md">
                <a href="{{ url('/home') }}">GamePC.</a>
            </div>
            @php
                $ip = $_SERVER['REMOTE_ADDR'];
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $time = date("Y-m-d H:i:s");
                //set a cookie to check if the user has already visited the site. if the cookie is set, don't log the ip.
                if(!isset($_COOKIE['visited'])) {
                    //use the model to insert the data into the database
                    $log = new \App\Models\visitors();
                    $log->ip = $ip;
                    $log->browser = $browser;
                    $log->time = $time;
                    $log->numberOfVisits = 1;
                    $log->save();
                    //set the cookie
                    setcookie('visited', 'true', time() + (86400 * 30), "/");
                }
                else{
                    $log = \App\Models\visitors::where('ip', $ip)->first();
                    $log->numberOfVisits = $log->numberOfVisits + 1;
                    try{
                        $log->save();
                    }
                    catch(\Exception $e){
                        $log = new \App\Models\visitors();
                        $log->ip = $ip;
                        $log->browser = $browser;
                        $log->time = $time;
                        $log->numberOfVisits = 1;
                        $log->save();
                    }
                }
            @endphp
        </div>

        <div class="links">
            <a href="{{ url('/about') }}">About</a>
        </div>
    </div>
</div>
</body>

</html>
