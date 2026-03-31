
@extends('backend.master')
@section('title')Role Edit @endsection
@section('content')
<div class="main-content">
    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card card-primary">
            <form class="form p-2" action="{{Route('admin.roles.update', $roles->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5>Edit Role</h5>
                        <div class="">
                            <a href="{{Route('admin.roles.index')}}"><i class="material-icons text-white rounded-circle bg-primary p-1">keyboard_backspace</i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body pb-0">
                            <div class="form-group">
                              <label style="margin-left:0px!important;">Role Name</label>
                              <input type="text" id="name" style="margin-left:0px!important;" name="name" value="{{$roles->name}}" class="form-control ms-0" required="">
                              @error('name')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label"></label>
                        <button type="submit"  class="btn ms-1 btn-primary">Update</button>
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















