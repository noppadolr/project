@extends('admin.body.main')
@section('title','User Profile')
@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Change Password</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">MyInventory</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-4">
            <div class="card">


                <div class="card-body">
                    <br>
                    <center>
                        <img class="card-img-top img-fluid rounded-circle avatar-xl"  src="{{ (!empty($data->photo))? url('upload/adminImages/'.$data->photo):url('upload/no_image.jpg') }}" alt="Card image cap">
                    </center>
                    <h4 class="card-title">User Profile</h4>
                    <hr>
                    <p class="card-text">Name : {{ $data->name }}</p>
                    <p class="card-text">Username : {{ $data->username }}</p>
                    <p class="card-text">Email : {{ $data->email }}</p>
                    <p class="card-text">Phone : {{ $data->phone }}</p>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Change Password</h4>
                    <br>

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif


                    <form action="{{ route('admin.update.password') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        {{--begin row--}}
                        <div class="row mb-3">
                            <label for="current_password" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('current_password') is-invalid @enderror" type="password" placeholder="" name="current_password" id="current_password" >
                                @error('current_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>
                        {{--end row--}}
                        {{--begin row--}}
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="" name="password" id="password" >
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                        {{--end row--}}

                        {{--begin row--}}
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                       placeholder=""
                                       name="password_confirmation" id="password_confirmation" >
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                        {{--end row--}}



                        <br>
                        <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Update Password</button>
                    </form>

                </div>
            </div>
        </div>
    </div><!-- end row -->
    @push('scripts')
{{--        <script type="text/javascript">--}}
{{--                @if(session('error'))--}}
{{--            {--}}
{{--                $(document).ready(function () {--}}

{{--                    const Toast = Swal.mixin({--}}
{{--                        toast: true,--}}
{{--                        position: 'top-end',--}}
{{--                        showConfirmButton: false,--}}
{{--                        timer: 2500,--}}
{{--                        timerProgressBar: true,--}}
{{--                    });--}}
{{--                    Toast.fire({--}}
{{--                        icon: 'error',--}}
{{--                        title: '{{ session('error') }}'--}}
{{--                    });--}}
{{--                })--}}
{{--            }--}}
{{--            @endif--}}
{{--        </script>--}}
    @endpush
@endsection
