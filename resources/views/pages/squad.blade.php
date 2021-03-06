{{dd('asd')}}
@extends('layouts.app')
@section('meta-keywords')
    <meta name="description" content="Create an amazing fantasy cricket team with one of the 11 player configurations at Gamithon Fantasy and enjoy playing…">
@endsection
@section('title')
    Create Team
@stop
@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-heading">
                        Tournament and Series
                    </h1>
                    <hr class="light full">
                    <div class="page-content" style="margin-bottom: 80px;">


                        <!-- your content -->

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped ">
                                <thead class="main-taible-head">
                                <tr>

                                    <th class="border-r">Tournament and Series</th>
                                    {{--<th class="border-r">Points Required To Play</th>--}}
                                    <th class="th2"></th>
                                </tr>
                                </thead>
                                <tbody id="selected-player" class="main-taible-body">
                                @foreach($tournaments_list as $row)
                                    @if(is_active_tournament($row['id']))
                                        <tr>
                                            <td class="border-r1" style="min-width: 305px;">
                                                {{--<img id="myteamtimg" class="img-circle img-thumbnail" style="width: 100px;"--}}
                                                {{--src="{{getUploadsPath($row['t_logo'])}}"/>--}}
                                                <h5>{{$row['name']}}</h5>
                                            </td>

                                            {{--<td class="border-r1">--}}
                                            {{--<p class="myteamtt"--}}
                                            {{--style="padding-top:34px;">{{$row['tournament_price']}}</p></td>--}}
                                            <td class="border-r1">

                                                @if($team=has_user_team(\Auth::id(),$row['id']))

                                                    <a href="{{route('teamdetail',['team_id'=>$team->id])}}"
                                                       class="btn btn-green">
                                                        View Team
                                                    </a>


                                                @else
                                                    <a href="{{route('addTeam', ['tournament_id'=>$row['id']])}}"
                                                       class="btn btn-green">
                                                        Create Team
                                                    </a>
                                                @endif

                                            </td>

                                    @endif
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                        <!-- your content -->


                    </div>
                </div>
            </div>
        </div>
        <br> <br> <br> <br> <br> <br> <br><br> <br> <br><br> <br><br> <br>
    </section>
@endsection
