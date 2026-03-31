@extends('backend.master')
@section('title')User Create @endsection
@section('content')
<div class="main-content">
    <section class="section userr">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card card-primary">
            <form class="form p-2" action="{{Route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Ctreate New User</h5>
                        <div class="">
                            <a href="{{Route('admin.users.index')}}"><i class="material-icons text-white rounded-circle bg-primary p-1">keyboard_backspace</i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name"  value="{{ old('first_name') }}" class="form-control">
                                @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name"  value="{{ old('last_name') }}" class="form-control">
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Email</label>
                                <input type="email" name="email" id="email"  value="{{ old('email') }}" class="form-control">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Status</label>
                                <select class="form-control selectric rounded" name="status" id="status">
                                <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">De-Active</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4 align-items-center">
                                <label class="col-form-label col-md-4" style="padding-left:0px !important;">Password</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="password"  style="margin:0px 0px !important;"  value="{{ old('password') }}"  name="password" id="password" data-indicator="pwindicator" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4 align-items-center">
                                <label class="col-form-label col-md-4" style="padding-left:0px !important;">Confirm Password</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="password" style="margin:0px 0px !important;"  value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group  mb-4">
                                <label class="col-form-label" style="margin-left: 0px !important;">Image</label>
                                <div class="img-views">
                                    <label class="input-preview text-center" for="img"><input ,="" class="input-preview__src btn btn-dark" id="img" name="image" type="file" /></label>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Role</label>
                                <select class="form-control rounded selectric" name="roles" id="status">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                                </select>
                                @error('roles')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4 mt-3">
                        <label class="col-form-label"></label>
                        <button type="submit"  class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        togglePasswordButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const targetId = button.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    button.innerHTML = '<i class="fas fa-eye-slash" id="eyeIcon"></i>';
                } else {
                    passwordInput.type = 'password';
                    button.innerHTML = '<i class="fas fa-eye" id="eyeIcon"></i>';
                }
            });
        });
    });
</script>
@endsection







