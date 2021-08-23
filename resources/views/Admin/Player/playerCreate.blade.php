
@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Add new player</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item "><a href="/admin/player">Players</a> </li>
                            <li class="breadcrumb-item active">Create</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            @include('Admin.layouts.message')
            <div class="card">
                <div class="card-header">
                    <form method="POST" action="{{ Route('store.excel.player') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="download-file float-right mr-3 mb-4">
                                Download Sample file  <a class="btn btn-success btn-sm" href="{{ Asset('sample/player_sheet.xlsx') }}" download><i data-feather="download" style="height: 20px"></i></a>
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"  name="player_sheet" id="player-sheet" required>
                                        <label class="custom-file-label" for="player-sheet">Upload Excel Sheet</label>
                                    </div>
                                   @if(isset($errors) && $errors->any())
                                       <div class="alert alert-danger mt-2">
                                          @foreach($errors->all() as $error)
                                              {{ $error }}
                                           @endforeach
                                       </div>
                                    @endif
                                    @error('player_sheet')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-3">
                                <button type="submit" class="btn btn-success btn-md">Upload</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-body">

                    <div class="form-body">
                        <form method="POST" action="/admin/player">
                            @csrf
                            <div class="form-group">
                                <label for="field1">Player Mobile Number</label>
                                <input type="text" class="form-control" id="field1" name="mobile_number">
                                <div class="text-danger">{{ $errors->first('mobile_number')}}</div>

                            </div>
                            <div class="form-group">
                                <label for="field1">First Name</label>
                                <input type="text" class="form-control" id="field1" name="first_name" required>
                                <div class="text-danger">{{ $errors->first('first_name')}}</div>

                            </div>
                            <div class="form-group">
                                <label for="field1">Last Name</label>
                                <input type="text" class="form-control" id="field1" name="last_name" required>
                                <div class="text-danger">{{ $errors->first('last_name')}}</div>

                            </div>
                            <div class="form-group">
                                    <label class="col-form-label">Player Role</label>
                                    <select class="form-control" name="role_id" required="" >
                                        <option selected="" disabled="" value="">Choose...</option>
                                        @foreach($masterRoles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Batting Style</label>
                                <select class="form-control" name="batting_style_id"  required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    @foreach($masterBattingStyles as $style)
                                    <option value="{{ $style->id }}">{{ $style->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Bowling Style (optional)</label>
                                <select class="form-control" name="bowling_style_id" >
                                    <option selected="" disabled="" value="">Choose...</option>
                                    @foreach($masterBowlingStyles as $style)
                                        <option value="{{ $style->id }}">{{ $style->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            @include('Admin.layouts.errors')
                            <button type="submit" class="btn btn-success btn-block">Add Player</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
