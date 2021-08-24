
        @extends('Admin.layouts.base')

        @section('content')
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Feedbacks</h3>
{{--                                <a class="btn btn-success btn-sm mr-2" href="{{ Route('feedbacks.create') }}"><i class="cil-user-plus"></i> Add New Team</a>--}}
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item active">Feedbacks</li>
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
                            @include('Admin.layouts.message')
                                <div class="tables">
                                    <table class="table table-responsive-sm">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($feedbacks as $f)
                                            <tr>

                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{$f->name}}</td>
                                                <td>{{$f->email}}</td>
                                                <td>{{$f->subject}}</td>
                                                <td>
                                                                                    <a class="btn btn-warning btn-sm"
                                                                                       href="/super-admin/feedbacks/{{$f->id}}"> Details </a>
{{--                                                    <a class="btn btn-success btn-sm"--}}
{{--                                                       href="/admin/feedback/{{$f->id}}/edit"> Edit </a>--}}

                                                        <form style="display:inline-block" method="POST"
                                                              action="/super-admin/feedbacks/{{$f->id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')"> Delete </button>
                                                        </form>


                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
@endsection
@section('js')

@endsection
