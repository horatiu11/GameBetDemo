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
        <div id="content">
            <div id="content-2x" style="top: 150px;">
                @if($challenge == null)
                <center>
                    <h4 style="color:#000;">GameBet Demo - Challenge Page</h4>
                        
                    <h4 id="error"></h4>

                    <h1 style="color:#000;">Please select a user to challenge</h1>
                    @if(Auth::user()->id == 1)
                      <button id="button" class="blue globalRadius challenge" type="button">Challenge User 2</button>
                    @else
                      <button id="button" class="green globalRadius challenge" type="button">Challenge User 1</button>
                    @endif
                </center>
                @else
                 <center>
                    <h4 style="color:#000;">GameBet Demo</h4>
                        
                    <h4 id="error"></h4>

                    <h1 style="color:#000;">You have been challenged by User{{3-Auth::user()->id}}. Accept or decline below</h1>
                      <button id="button" class="blue globalRadius challenge" type="button">Accept</button>
                      <button id="button" class="green globalRadius challenge" type="button">Decline</button>
                </center>
                @endif
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
    @if($challenge == null)
    setTimeout(function(){
                        window.location.reload(1);
                    }, 10000);
    @endif

    $('.blue.challenge').click(function(){
        $.ajax({
            method:'POST',
            @if($challenge == null)
            url: '{{ route("challengeEnter") }}',
            @else
            url: '{{ route("challengeAccept") }}',
            @endif

            @if($challenge == null)
            data:{id:2},
            @else
            data:{decision: 2},
            @endif

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "{{ route('waitPage') }}";
            },
            error:function(xhr, status, text){
                if(xhr.status == 400)
                {   
                    var error = xhr.responseJSON.error;
                    $('#error').html(error);
                    $('#error').show();
                }
            }
        });
    });

    $('.green.challenge').click(function(){
        $.ajax({
            method:'POST',
            @if($challenge == null)
            url: '{{ route("challengeEnter") }}',
            @else
            url: '{{ route("challengeAccept") }}',
            @endif

            @if($challenge == null)
            data:{id:1},
            @else
            data:{decision: 0},
            @endif
            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                window.location.href = "{{ route('waitPage') }}";
            },
            error:function(xhr, status, text){
                if(xhr.status == 400)
                {
                    var error = xhr.responseJSON.error;
                    $('#error').html(error);
                    $('#error').show();
                }
            }
        });
    });
</script>
