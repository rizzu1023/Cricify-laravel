{{--    <style>--}}
{{--        .single-name {--}}
{{--            display: inline-block;--}}
{{--            margin-left: 10px;--}}
{{--            padding: 5px 0;--}}
{{--            font-size: 20px;--}}
{{--            /* background:orange; */--}}
{{--        }--}}

{{--        .single-div {--}}
{{--            background: #fff;--}}
{{--            border-right: 1px solid gray;--}}
{{--        }--}}
{{--    </style>--}}


@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('Admin.layouts.message')
                </div>
                <div class="card-body">
                    <div class="main-page">
                        <form method="POST" action="{{route('ScoreDetails')}}" id="score-detail-form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="field1">Overs</label>
                                    <input type="number" class="form-control" name="overs" value="20" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleFormControlSelect2">Who won the Toss</label>
                                    <select class="form-control" id="exampleFormControlSelect2" name="toss" required>
                                        <option disabled selected>Select Team</option>
                                        <option
                                            value="{{$schedule->team1_id}}">{{$schedule->Teams1->team_name}}</option>
                                        <option
                                            value="{{$schedule->team2_id}}">{{$schedule->Teams2->team_name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleFormControlSelect2">Choose To</label>
                                    <select class="form-control" id="exampleFormControlSelect2" name="choose" required>
                                        <option disabled selected>Choose</option>
                                        <option value="Bat">Batting</option>
                                        <option value="Bowl">Bowling</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 single-div mt-3">
                                    <h5 class="title1 mb-3">SELECT {{$schedule->Teams1->team_name}} XI</h5>
                                    @foreach($players1 as $p1)
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="team1-checkbox custom-control-input"
                                                   onchange="team1_function(this)"
                                                   id="{{$p1->player_id . 'team1'}}" name="team1[]"
                                                   value="{{$p1->player_id}}">
                                            <label class="custom-control-label "
                                                   style="font-size: 18px;font-weight: normal"
                                                   for="{{$p1->player_id . 'team1'}}">{{$loop->iteration}} {{$p1->first_name}} {{$p1->last_name}}</label>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="col-md-6 single-div mt-3">
                                    <h5 class="title1 mb-3">SELECT {{$schedule->Teams2->team_name}} XI</h5>

                                    @foreach($players2 as $p2)
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="team2-checkbox custom-control-input"
                                                   onchange="team2_function(this)"
                                                   id="{{$p2->player_id . 'team2'}}" name="team2[]"
                                                   value="{{$p2->player_id}}">
                                            <label class="custom-control-label "
                                                   style="font-size: 18px;font-weight: normal"
                                                   for="{{$p2->player_id  . 'team2'}}">{{$loop->iteration}} {{$p2->first_name}} {{$p2->last_name}}</label>
                                        </div>

                                        {{--                        <input onchange="team2_function(this)" class="single-checkbox" type="checkbox" name="team2[]" value="{{$p2->player_id}}"><div class="single-name"></div><br>--}}
                                    @endforeach
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="field1">1st Umpire Name (optional)</label>
                                    <input type="text" class="form-control" name="umpire_1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="field1">2nd Umpire Name (optional)</label>
                                    <input type="text" class="form-control" name="umpire_2">
                                </div>
                            </div>


                            <input type="hidden" name="id" value="{{$schedule->id}}">
                            <input type="hidden" name="team1_id" value="{{$schedule->team1_id}}">
                            <input type="hidden" name="team2_id" value="{{$schedule->team2_id}}">
                            <input type="hidden" name="tournament_id" value="{{$schedule->tournament_id}}">

{{--                            <button class="btn btn-primary" id="save">Save</button>--}}
                            <button class="btn btn-primary mt-3" id="start">Start Match</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@section('js')
    <script>

        const max_limit = {!! str_replace("'", "\'", json_encode($player_max_limit)) !!};

        $(document).ready(function () {
            $(".team1-checkbox:input:checkbox").each(function (index) {
                this.checked = (".single-checkbox:input:checkbox" < max_limit);

            }).change(function () {
                if ($(".team1-checkbox:input:checkbox:checked").length > max_limit) {
                    this.checked = false;
                    alert('You can select maximum ' + max_limit + ' players');
                }
            });

            $(".team2-checkbox:input:checkbox").each(function (index) {
                this.checked = (".single-checkbox:input:checkbox" < max_limit);

            }).change(function () {
                if ($(".team2-checkbox:input:checkbox:checked").length > max_limit) {
                    this.checked = false;
                }
            });
        });


        function team1_function(player_object) {

            if ($(player_object).is(":checked")) {
                var team2 = $("input[name='team2[]']:checked").map(function () {
                    return $(this).val();
                }).get();
                var check = team2.includes(player_object.value);
                if (check) {
                    $(player_object).prop('checked', false);
                    alert('this player is already selected in other team');
                }
            }
        }

        function team2_function(player_object) {
            if ($(player_object).is(":checked")) {
                var team1 = $("input[name='team1[]']:checked").map(function () {
                    return $(this).val();
                }).get();
                var check = team1.includes(player_object.value);
                if (check) {
                    $(player_object).prop('checked', false);
                    alert('this player is already selected in other team');
                }
            }
        }


        $('#score-detail-form').on('submit', function (e) {
            e.preventDefault();

            // $('#save, #start').click(function () {
            //     if (this.id === 'save') {
            //         var submit_type = 'save'
            //         alert('save');
            //     } else if (this.id === 'start') {
            //         var submit_type = 'start'
            //     }
            // });
            $.ajax({
                type: "POST",
                url: '{{Route('ScoreDetails')}}',
                data: $(this).serialize(),
                success: function (data) {
                    if (!data.status) {
                        alert(data.message);
                    } else {
                        // window.location.replace('/admin/tournaments/' + data.tournament_id + '/schedules')
                        window.location.replace('/admin/LiveUpdate/'+data.match_id+'/'+data.tournament_id);
                    }
                },
                error: function (data) {

                    if (data.status === 422) {
                        alert('Please select proper data');
                    }
                }
            });
        });

    </script>
@endsection
