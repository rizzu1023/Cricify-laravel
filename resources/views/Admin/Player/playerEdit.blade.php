
@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Edit</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        @if($player->getFirstMedia('player-image'))
                            <img src="{{ $player->getFirstMedia('player-image')->getUrl('player-profile') }}">
                        @endif
                    </div>
                    <div class="form-body">
                        <form method="POST" action="/admin/player/{{$player['player_id']}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="field20">Player Image</label>
                                <input type="file" class="form-control" id="field20" name="player_image" >
                                <div>{{ $errors->first('player_image')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="field1">Player Mobile Number</label>
                                <input type="text" class="form-control" id="field1" name="mobile_number" value="{{$player['mobile_number']}}">
                                <div>{{ $errors->first('player_id')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="field1">First Name</label>
                                <input type="text" class="form-control" id="field1" name="first_name" value="{{$player['first_name']}}">
                                <div>{{ $errors->first('first_name')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="field1">Last Name</label>
                                <input type="text" class="form-control" id="field1" name="last_name" value="{{$player['last_name']}}">
                                <div>{{ $errors->first('last_name')}}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Player Role</label>
                                <select class="form-control" name="role_id" required="" >
                                    <option selected="" value="{{$player->Role->id}}">{{$player->Role->name}}</option>
                                    @foreach($roles as $style)
                                        <option value="{{$style->id}}">{{$style->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Batting Style</label>
                                <select class="form-control" name="batting_style_id" required="" >
                                    <option selected=""  value="{{$player->BattingStyle->id}}">{{$player->BattingStyle->name}}</option>
                                    @foreach($battingStyles as $style)
                                    <option value="{{$style->id}}">{{$style->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Bowling Style (optional)</label>
                                <select class="form-control" name="bowling_style_id" required="" >
                                    <option selected=""  value="{{$player->BowlingStyle->id}}">{{$player->BowlingStyle->name}}</option>
                                    @foreach($bowlingStyles as $style)
                                        <option value="{{$style->id}}">{{$style->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
