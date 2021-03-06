@extends('layouts.app')
@section('title')
   LeaderBoards
    @stop
@section('meta-keywords')

    <meta name="description" content="Gamithon fantasy is a cricket fantasy game where you can create your own team and win 50$ in every tournament…">
@endsection
@section('content')

    <section>
        <div class="container" style="min-height: 100%">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-heading">
                        Tournaments
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
                                    <tr>
                                        <td class="border-r1" style="min-width: 305px;">
                                            <h5>{{$row['name']}}</h5>
                                        </td>

                                        <td class="border-r1">
                                            <a href="{{route('homeleaderboard', ['id'=>$row['id']])}}"
                                               class="btn btn-green">
                                                Show LeaderBoard
                                            </a>
                                        </td>
                                    </tr>
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
