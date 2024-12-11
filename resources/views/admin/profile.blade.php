@extends('admin.body.main')
@section('title','User Profile')
@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">MyInventory</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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

                    <h4 class="card-title">แก้ไขข้อมูลส่วนบุคคล</h4>
                    <br>
<form action="{{ route('admin.update.profile') }}" method="POST" enctype="multipart/form-data" >
    @csrf
                    {{--begin row--}}
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name" id="name" value="{{ $data->name }}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    {{--end row--}}

                    {{--begin row--}}
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('username') is-invalid @enderror" type="text" placeholder="Username" name="username" id="username" value="{{ $data->username }}">
                            @error('username')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    {{--end row--}}

                    {{--begin row--}}
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" id="email" value="{{ $data->email }}">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    {{--end row--}}

                    {{--begin row--}}
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Phone" name="phone" id="phone" value="{{ $data->phone }}">
                        </div>
                    </div>
                    {{--end row--}}

                    {{--begin row--}}
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" placeholder="Photo" name="photo" id="image" value="{{ $data->photo }}">
                        </div>
                    </div>
                    {{--end row--}}

    <div class="row mb-2">
        <label for="showImage" class="col-sm-1 col-form-label"></label>
        <div class="col-sm-11 ">
            <img class="img-fluid rounded ml-15" id="showImage" style="width: 200px;height: 200px;" src="{{ (!empty($data->photo))? url('upload/adminImages/'.$data->photo):url('upload/no_image.jpg') }}" alt="">
        </div>
    </div>


    <br>
                    <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Update Profile</button>
</form>

                </div>
            </div>
        </div>
    </div><!-- end row -->

@push('scripts')

    <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>
    <script type="text/javascript">
        @if(session('success'))
        {
            $(document).ready(function () {
                // swal("Hello world!");
                {{--Swal.fire({--}}
                {{--    position: "top-end",--}}
                {{--    icon: "success",--}}
                {{--    title: "{{ session('success') }}",--}}
                {{--    showConfirmButton: false,--}}
                {{--    timer: 1500--}}
                {{--});--}}
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                })
            })
        }
        @endif
    </script>

@endpush
@endsection
