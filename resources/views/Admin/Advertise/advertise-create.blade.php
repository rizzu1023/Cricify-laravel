@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Add new Advertise</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item "><a href="/admin/advertise">Advertise</a></li>
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
                    @csrf
                    <div class="row">
                        <div class="col-md-9 col-9">
                            <div class="form-group">
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
                    </div>

                </div>
                <div class="card-body">

                    <div class="form-body">
                        <form method="POST" action="/admin/advertise" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="field20">Image</label>
                                <input type="file" class="form-control" id="field20" name="image" required>
                            </div>
                            <div class="form-group">
                                <label for="field1">Name</label>
                                <input type="text" class="form-control" id="field1" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="field1">Height</label>
                                <input type="number" class="form-control" id="field1" name="height" required value="100">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Page</label>
                                <select class="form-control" name="page" required>
                                    <option selected="" disabled="" value="">Select Page</option>
                                    <option value="tournament">Tournament</option>
                                    <option value="schedule">Tournament Schedule</option>
                                    <option value="result">Tournament Results</option>
                                    <option value="teams">Tournament Teams</option>
                                    <option value="stats">Tournament Stats</option>
                                    <option value="points-table">Tournament Points Table</option>
                                    <option value="info">Match Info</option>
                                    <option value="live">Match Live</option>
                                    <option value="scorecard">Match Scorecard</option>
                                    <option value="overs">Match Overs</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="field1">Start Date (optional)</label>
                                <input type="date" class="form-control" id="field1" name="start_date" >
                            </div>
                            <div class="form-group">
                                <label for="field1">End Date (optional)</label>
                                <input type="date" class="form-control" id="field1" name="end_date" >
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Tournament (optional)</label>
                                <select class="form-control" name="tournament_id">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    @foreach($tournaments as $t)
                                        <option value="{{ $t->id }}">{{ $t->tournament_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Team (optional)</label>
                                <select class="form-control" name="team_id" >
                                    <option selected="" disabled="" value="">Choose...</option>
                                    @foreach($teams as $t)
                                        <option value="{{ $t->id }}">{{ $t->team_name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            @include('Admin.layouts.errors')
                            <button type="submit" class="btn btn-success btn-block">Add Advertise</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
