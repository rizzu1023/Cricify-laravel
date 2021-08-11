
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
                            <div class="col-md-9 col-9">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"  name="player_sheet" id="player-sheet" required>
                                        <input type="hidden" name="team_id" value="{{ $team->id }}">
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
                            <div class="download-file float-right mr-3 mb-4">
                                Download Sample File<a class="btn btn-success btn-sm" href="{{ Asset('sample/player_sheet.xlsx') }}" download><i data-feather="download" style="height: 20px"></i></a>
                            </div>

                            <div class="col-md-3 col-3">
                                <button type="submit" class="btn btn-success btn-md">Upload</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
