@extends('backend.master')
@section("content")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-8">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit</h6>
                    <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput"
                               name="name" value="{{ $data->name }}" placeholder="name">
                            <label for="floatingInput">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput"
                                name="email" value="{{ $data->email }}" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="mb-3">
                            <input class="form-control form-control-lg bg-dark" id="image" type="file" name="profile_photo_path">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4">

                <div class="bg-secondary text-center rounded p-4">
                    <img id="showImage" class="img-fluid rounded-circle mx-auto mb-4" src="{{(!empty($data->profile_photo_path))? url('upload/user_images/'.$data->profile_photo_path): url('backend/img/testimonial-1.jpg')}}" style="width:246px;height:279px;" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>
    <script>
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
@endsection
