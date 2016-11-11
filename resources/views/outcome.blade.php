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
            <button id="button" class="blue globalRadius xyz"> Logout </button>
        </a>
        @if($challenge->state == 3 && $challenge->ended_at == null)
        <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo - Outcome</h4>
                    <h1 style="color:#000;">Challenge is over! Wait for the other oponent to select the outcome of the match too...</h1>
                    <h4 style="color:#000;">If in 15 mins he does not select anything, your outcome will be chosen as the correct one</h4>
                </center>
            </div>
        </div>
        @elseif($challenge->state == 3 && $challenge->user1_evidence == 0 && $challenge->user2_evidence == 0)
            <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo - Outcome</h4>
                    @if($challenge->user1_outcome == 'won' && $challenge->user2_outcome == 'won')
                    <h1 style="color:#000;">There was a mismatch between your selected outcome and the one of the oponent. Please, provide evidence of your win, or he will get the victory...</h1>
                    <a href="{{ route('evidencePage') }}">
                      <button id="button" class="blue globalRadius" type="button">Provide evidence</button>
                    </a>
                    
                    @elseif(($challenge->user1_outcome == 'won' && $challenge->user1_id == Auth::user()->id) || ($challenge->user2_outcome == 'won' && $challenge->user2_id == Auth::user()->id))
                    <h1 style="color:#000;">You won! Great job!</h1>
                      <button id="button" class="blue globalRadius challenge" type="button">Accept and return to select a new challenge</button>

                    @else
                    <h1 style="color:#000;">You lost... Better luck next time!</h1>
                      <button id="button" class="green globalRadius challenge" type="button">Accept and return to select a new challenge</button>

                    @endif
                </center>
            </div>
        </div>
        @elseif(($challenge->user1_evidence == 1 || $challenge->user2_evidence == 1) && $challenge->state == 3)
        <div id="content">
            <div id="content-2x" style="top: 150px;">
                <center>
                    <h4 style="color:#000;">GameBet Demo - Outcome</h4>
                    
                    <h1 style="color:#000;">Thank you! Please wait for the other user to select the outcome...</h1>

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

    @if(($challenge->state == 3 && $challenge->ended_at == null) || $challenge->user1_evidence == 1 || $challenge->user2_evidence == 1)
        setTimeout(function(){
            window.location.reload(1);
        }, 5000);
    @endif

    $('.blue.challenge').click(function(e){
       
        $.ajax({
            method:'POST',
            url: '{{ route("confirm") }}',
            data: {},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var r = confirm("Thank you! You have to wait for the other oponent to confirm it too! After this, you will be redirected to the Challenge Page!");
                if(r){
                    window.location.reload(1);
                }
            }
        });
    });

     $('.green.challenge').click(function(e){
       
        $.ajax({
            method:'POST',
            url: '{{ route("confirm") }}',
            data: {},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var r = confirm("Thank you! You have to wait for the other oponent to confirm it too! After this, you will be redirected to the Challenge Page!");
                if(r){
                    window.location.reload(1);
                }
            }
        });
    });

</script>
