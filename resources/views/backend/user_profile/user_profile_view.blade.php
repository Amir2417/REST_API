@extends('backend.master')
@section("content")

<div class="container-fluid pt-4 px-4">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div class="d-flex justify-content-between">
                <h5 class="mb-4">My Profile</h5>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-dark rounded-pill m-2">Edit</a>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item text-center">
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{(!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path): url('backend/img/testimonial-1.jpg')}}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1 text-uppercase">{{ $data->name }}</h5>
                    <p>{{ $data->email }}</p>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
