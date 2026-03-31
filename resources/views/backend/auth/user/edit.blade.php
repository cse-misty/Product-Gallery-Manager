@extends('backend.master')
@section('title')Edit User @endsection
@section('content')
<div class="main-content">
    <section class="section userr">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card card-primary">
            <form class="form p-2" action="{{Route('admin.users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @php
                    $name = explode(" ", $user->name);
                    $lastname = array_pop($name);
                    $firstname = implode(" ", $name);
                @endphp
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Edit User</h5>
                        <div class="">
                            <a href="{{Route('admin.users.index')}}"><i class="material-icons text-white rounded-circle bg-primary p-1">keyboard_backspace</i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{$firstname}}" class="form-control">
                                @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{$lastname}}" class="form-control">
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Email</label>
                                <input type="email" name="email" id="email"  value="{{$user->email}}" class="form-control">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Status</label>
                                <select class="form-control selectric rounded" name="status" id="status">
                                    <option value="1" {{$user->status == 1 ? 'selected': ''}}>Active</option>
                                    <option value="2" {{$user->status == 2 ? 'selected':''}}>De-Active</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group  mb-4">
                                <label class="col-form-label" style="margin-left: 0px !important;">New Image</label>
                                <div class="img-views">
                                    <label class="input-preview text-center" for="img"><input ,="" class="input-preview__src btn btn-dark" id="img" name="image" type="file" /></label>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 ">
                            <div class="form-group mb-4">
                                <label class="col-form-label" style="margin-left: 0px !important;">Old Image</label>
                                <div class="img-views">
                                    <img src="{{asset('backend/img/user')}}/{{ $user->image }}" alt="" class="img-fluid input-preview" width="250">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="form-group row mb-4">
                                <label class="col-form-label">Role</label>
                                <select class="form-control selectric rounded" name="roles" id="roles">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" @if(old('roles', $user->role) == $role->name) selected @endif>{{ $role->name }}</option>
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
                        <button type="submit"  class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
</div>
@endsection
