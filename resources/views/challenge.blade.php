<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">


    </head>

    <body>
        <a style="float:right; margin-right:1em;" href="{{ route('logout') }}">
            <button id="button" class="blue globalRadius"> Logout </button>
        </a>
        <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo - Challenge Page</h4>
                    <h1 style="color:#000;">Please select a user to challenge</h1>
                    @if(Auth::user()->id == 1)
                      <button id="button" class="blue globalRadius" type="button">Login as User 1</button>
                    @else
                      <button id="button" class="blue globalRadius" type="button">Login as User 2</button>
                    @endif
                </center>
            </div>
        </div>

    </body>
</html>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">
</script>

<script>
    $('.blue').click(function(){
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

    $('.green').click(function(){
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
</script>
