@extends('backend.master')
@section("content")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Change Password</h6>
                    <form action="{{ route('user.profile.change.password.update') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput"
                               name="current_password" placeholder="Current Password">
                            <label for="floatingInput">Current Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput"
                               name="password" placeholder="New Password">
                            <label for="floatingInput">New Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingInput"
                               name="password_confirmation" required placeholder="Re-type Password">
                            <label for="floatingInput">Re-type Password</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



