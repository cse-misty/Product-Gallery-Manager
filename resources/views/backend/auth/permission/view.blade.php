@extends('backend.master')
@section('title') Permission view - Admin Panel @endsection
@section('content')


<div class="main-content" style="padding-top: 110px;">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-">
                <div class="card">
                  <div class="card-header mt-2 d-flex justify-content-between">
                    <h4>Permission Name <span class="badge btcolor3 badge-shadow m-2">{{$permissions->name}}</span></h4>
                    <a href="{{Route('admin.permissions.index')}}"><i class="material-icons text-white rounded-circle bg-primary p-1">keyboard_backspace</i></a>
                  </div>

                    <div class="p-3 ml-4">
                        @if ($permissions->roles)
                        @foreach ($permissions->roles as $permission_roles)
                        @php
                            $ra = rand(1,3)
                        @endphp

                        <a class="btn btn-primary text-white" onclick="confirm_delete_backend({{$permissions->id, $permission_roles->id}})">
                            {{$permission_roles->name}}
                        </a>
                        <form action="{{Route('admin.permissions.roles.remove', [$permissions->id, $permission_roles->id])}}"
                            id="delete_form_{{$permissions->id, $permission_roles->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>

                        @endforeach
                        @endif
                    </div>
                  <div class="card-body">
                    <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                        <li class="media">
                            <div class="media-body">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                        <h4>New Role Assign</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <form class="form p-2" action="{{route('admin.permissions.roles', $permissions->id)}}" method="post">
                                                    @csrf
                                                    <label for="permissions fw-bold">Asign New Role</label>
                                                    <select class="form-control select"  name="roles" id="roles" autocomplete="roles-name">
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endforeach
                                                    </select>
                                                    @error('name')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <br>
                                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection



