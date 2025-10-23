<?php $page = 'users'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h4>Profile</h4>
                </div>
                <div class="card-body profile-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="mb-2"><i class="ti ti-user text-primary me-1"></i>Basic Information</h5>
                        <div class="profile-pic-upload image-field">
                            <div class="profile-pic p-2">
                                <img id="profilePreview" 
                                    src="{{ $user->staff_picture }}" 
                                    class="object-fit-cover h-100 rounded-1" 
                                    alt="User Photo">
                                <button type="button" class="close rounded-1 remove-image">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="hidden" name="remove_staff_picture" value="0">
                            </div>

                            <div class="mb-3">
                                <div class="image-upload mb-0 d-inline-flex">
                                    <input type="file" name="staff_picture" id="staffPictureInput">
                                    <div class="btn btn-primary fs-13">Change Image</div>
                                </div>
                                <p class="mt-2">Upload an image below 2 MB, Accepted File format JPG, PNG</p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Ukmper</label>
                                    <input type="text" class="form-control" name="ukmper"
                                        value="{{ old('ukmper', $user->ukmper) }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="telephone"
                                        value="{{ old('telephone', $user->telephone) }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">User Type</label>
                                    <input type="text" class="form-control" name="user_type"
                                        value="{{ old('user_type', $user->user_type) }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Roles</label>
                                    <select name="roles[]" class="form-control select2" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Back</a>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0 text-gray-9">2014 - 2025 &copy; DreamsPOS. All Right Reserved</p>
            <p>Designed &amp; Developed by <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
        </div>
    </div>

    <script>
        $('.select2').select2({
            placeholder: "Select roles",
            allowClear: true,
            width: '100%',
            tags: true
        });
    </script>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    let removeBtn = document.querySelector(".remove-image");
    let hiddenInput = document.querySelector("[name='remove_staff_picture']");
    let previewImg = document.getElementById("profilePreview");
    let fileInput = document.getElementById("staffPictureInput");

    // Remove current image
    removeBtn.addEventListener("click", function () {
        previewImg.src = ""; 
        hiddenInput.value = 1; 
    });

    fileInput.addEventListener("change", function (e) {
        if (e.target.files && e.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);

            hiddenInput.value = 0; 
        }
    });
});
</script>

