<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>

    <body>
        <a href="/login/1">
            <button> Login as User 1 </button>
        </a>
        <br>
        <a href="/login/2">
            <button> Login as User 2 </button>
        </a>
        <br>
        <a href="/logout">
            <button> Logout </button>
        </a>

        @if(Auth::check())
            Logged in as {{Auth::user()->name}}
        @endif
    </body>
</html>
