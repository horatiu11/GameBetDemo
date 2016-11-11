<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GameBet Demo</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">


    </head>

    <body>
        <a style="float:right; margin-right:1em;" href="{{ route('logout') }}">
            <button id="button" class="blue globalRadius"> Logout </button>
        </a>
        @if($challenge->state == 1)
        <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo</h4>
                    <h1 style="color:#000;">Please, wait for your opponent to accept the challenge...</h1>
                </center>
            </div>
        </div>
        @else
            <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo</h4>
                    <h1 style="color:#000;">The competition started! After it ends, please select one of the outcomes below...</h1>
                    <button id="button" class="blue globalRadius challenge" type="button">I won!</button>
                    <button id="button" class="green globalRadius challenge" type="button">I lost!</button>
                </center>
            </div>
        </div>
        @endif

    </body>
</html>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">
</script>

<script>

    setTimeout(function(){
        window.location.reload(1);
    }, 5000);

    $('.blue challenge').click(function(){
        $.ajax({
            method:'POST',
            url: '{{ route("login") }}',
            data:{id:2},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "{{ route('challengePage') }}";
            }
        });
    });

    $('.green challenge').click(function(){
        $.ajax({
            method:'POST',
            url: '{{ route("login") }}',
            data:{id:1},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "{{ route('challengePage') }}";
            }
        });
    });
</script>
