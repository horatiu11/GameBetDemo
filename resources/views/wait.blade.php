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
                    <h1 style="color:#000;">Please, wait for your opponent to accept the challenge...If he declines, you will be redirected to the Challenge Page</h1>
                </center>
            </div>
        </div>
        @elseif($challenge->state >= 2)
            <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo</h4>
                    @if($challenge->state == 2)
                    <h1 style="color:#000;">The competition started! After it ends, please select one of the outcomes below...</h1>
                    @else
                    <h1 style="color:#000;">It seems that the other user already picked an outcome... Please, do the same ASAP!</h1>
                    @endif
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

    @if($challenge->state == 1)
    setTimeout(function(){
        window.location.reload(1);
    }, 5000);
    @endif

    $('.blue.challenge').click(function(){
        $.ajax({
            method:'POST',
            url: '{{ route("challengeOutcome") }}',
            data:{outcome: 1},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "{{ route('outcomePage') }}";
            }
        });
    });

    $('.green.challenge').click(function(){
        $.ajax({
            method:'POST',
            url: '{{ route("challengeOutcome") }}',
            data:{outcome: 0},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "{{ route('outcomePage') }}";
            }
        });
    });
</script>
