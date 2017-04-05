@php

//dd($tournament_detail);

@endphp
@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-heading">
                    Make your team
                </h1>
                <hr class="light full">
                <div class="page-content">
                    <div class=" col-md-6">
                        <img src="{{getUploadsPath($tournament_detail['t_logo'])}}" class="img-fluid" alt="Responsive image" />
                    </div>
                    <div class="col-md-6">
                        <h3>{{$tournament_detail['name']}}</h3>
                        <br>
                        <h4 class="tnt1">Tournament Cost:<span class="tnt2">{{$tournament_detail['tournament_price']}}</span></h4>
                        <br>
                        <h4 class="tnt1">Current Points:<span class="tnt2">{{getUserTotalScore(Auth::id())}}</span></h4>
                        <div class="col-md-5">

                            <form id="team_submit">
                                <input type="text" id="team_name" class="fw form-control"
                                       placeholder="Enter Your Team Name">
                                <button id="save_button" type="submit" class="btn  btn-lg btn-block save-button">SAVE</button>
                            </form>
                            <br>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!------------>

<!-- .....................TeamStart............................... -->
<section class="team">
    <div class="countaner">
        <section>

        </section>
        <section>

        </section>
    </div>
    <!-- .....................Team End............................... -->
    <div class='error' style='display:none'></div>

</section>



@endsection
@section('addteamjs')
<script>
    $("#team_submit").submit(function (event) {
    event.preventDefault();
    var teamName = $("#team_name").val()
            var tournamentId = '{{$tournament_detail['id']}}';
    $.ajax({
    type: 'GET',
            url: '{{route('teamNamePostAjax')}}',
            data: {tournament_id: tournamentId, name: teamName},
            success: function (data) {
            if (data.status == "ok") {
            $("#team_name").attr('disabled', true);
            $("#save_button").remove();
            $('.error').html('team added sucessfully');
            $('.error').fadeIn(400).delay(3000).fadeOut(400); //fade out after 3 seconds
            window.location.reload();
            $('<input type="hidden" id="team_id" value="' + data.team_id + '"/>').insertBefore("#addstatus");
            }
            else {
            if (data.status == "no"){

            $('.error').html(data.message);
            $('.error').fadeIn(400).delay(3000).fadeOut(400); //fade out after 3 seconds
            return;
            }
            $('.error').html('Team Name Already taken');
            $('.error').fadeIn(400).delay(3000).fadeOut(400); //fade out after 3 seconds

            }

            }
    });
    });
</script>
{{--<script>--}}
            {{--function addp                                layertoteam(rolename, roleid, player                                id, tournamentid) {--}}
        {{--var arr_pl                                ayer_id = [];--}}
        {{--arr_player_id.push(p                                layerid);--}}
        {{--var teamid = $("#team_id").val();--}}                                
        {{--var player_p                                rice = $("#player_price").                                html();--}}

        {{--$.ajax({--}}
        {{--type: 'POST',                                --}}
        {{--url: '{                                {route('addUserTeamPlayerAjax')}}',--}}
        {{--data: {--}}
        {{--tournament_                                id: tournamentid,--}}
        {{-                                -player_id: arr_player_id,--}}
        {{--role_id: roleid,--}}
        {{--role_                                name: rolename,--}}
        {{--player_price: player_price,-                                -}}
        {{--tea                                m_id: teamid, _token: '{{csrf_token()}}'                                --}}
            {{--},--}}
            {{--success: func                              tion (data) {--}}

        {{--if (data.success == true) {--}}
        {{--$('#btn-                                player-' + playerid).a                                ttr('disabled',                                true);--}}
        {{--$('#btn-pl                                ayer-' + playe                                rid).attr('class', 'btn                              btn-danger');--}}

     {{--} else {--}}

        {{--}--}}

        {{--}--}}
        {{--});--}}
        {{--}--}}
  {{--</script>--}}

       @endsection