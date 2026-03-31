@extends('backend.master')
@section('title')Dashboard @endsection
@section('content')

@section('style')
<style>
    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        width: 100% !important;
        }
</style>
@endsection

<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                        @if (empty($user->image))
                        <!-- If $users->image is empty, show a default image -->
                        <img alt="image" src="{{ asset('backend/img/user/bdcham.png') }}" class="rounded author-box-picture">
                        @else
                            <!-- If $users->image is not empty, show the user's image -->
                            <img alt="image" src="{{ asset('backend/img/user/' . $user->image) }}" class="rounded author-box-picture">
                        @endif

                      <div class="clearfix"></div>
                      <div class="mt-2 author-box-name">
                        <a href="#">{{$user->name}}</a>
                      </div>
                      <div class="author-box-job">{{$user->job}}</div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-description">
                        <p>
                        {{$user->about}}
                        </p>
                      </div>
                      <div class="mb-2 mt-3">
                        <div class="text-small font-weight-bold">Follow Hasan On</div>
                      </div>
                      <a href="{{$user->facebook}}" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="{{$user->twitter}}" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a href="{{$user->instagram}}" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                          aria-selected="true">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#role" role="tab"
                          aria-selected="false">Role</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#permission" role="tab"
                          aria-selected="false">Permission</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">



                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8">{{$user->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Company</div>
                            <div class="col-lg-9 col-md-8">{{$user->company }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Job</div>
                            <div class="col-lg-9 col-md-8">{{$user->job }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Country</div>
                            <div class="col-lg-9 col-md-8">{{$user->country }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Address</div>
                            <div class="col-lg-9 col-md-8">{{$user->address }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8">{{$user->phone }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{$user->email }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Password</div>
                            <div class="col-lg-9 col-md-8">{{$user->normalpass }}</div>
                        </div>
                      </div>

                      <!-- Role assign -->

                      <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="profile-tab2">
                                <div class="user_role">

                                <div class="py-3 d-flex">
                                    @if ($user->roles)
                                        @foreach ($user->roles as $user_roles)
                                        @php
                                            $ra = rand(1,3)
                                        @endphp
                                            <form action="{{Route('admin.users.roles.remove', [$user->id, $user_roles->id])}}" onsubmit="return confirm('Are you sure Delete This Role');" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge btcolor{{$ra}} badge-shadow mx-2" type="submit">{{$user_roles->name}}</button>
                                            </form>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 pt-4">
                                    <div class="card">
                                    <div class="card-header">
                                        <h4>New Role Assign</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <form class="form p-2" action="{{route('admin.users.roles', $user->id)}}" method="post">
                                            @csrf
                                            <label for="permissions fw-bold">Asign New Role</label> <br>
                                            <select class="form-control select2"  name="roles" id="roles" autocomplete="roles-name">
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
                    </div>

                    <!-- Permission -->
                    <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="profile-tab3">
                                <div class="user_role">

                                <div class="py-3 "  style="display:flow-root;">
                                @foreach ($userpermissions as $user_permission)
                                  @php
                                    $ra = rand(1,3)
                                  @endphp
                                        <form style="float:left" action="{{Route('admin.users.permissions.revoke', [$user->id, $user_permission->id])}}" onsubmit="return confirm('Are you sure');" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="float:left" class="badge btcolor{{$ra}} badge-shadow mx-2" type="submit">{{$user_permission->name}}</button>
                                        </form>
                                @endforeach
                                @if ($user->permissions)
                                    @foreach ($user->permissions as $user_permission)
                                    @php
                                        $ra = rand(1,3)
                                    @endphp
                                        <form action="{{Route('admin.users.permissions.revoke', [$user->id, $user_permission->id])}}" onsubmit="return confirm('Are you sure');" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="float:left" class="badge btcolor{{$ra}} badge-shadow mx-2" type="submit">{{$user_permission->name}}</button>
                                        </form>
                                    @endforeach
                                @endif
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 pt-4">
                                    <div class="card">
                                    <div class="card-header">
                                        <h4>New Permission Assign</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <form class="form p-2" action="{{route('admin.users.permissions', $user->id)}}" method="post">
                                            @csrf
                                            <label for="permissions fw-bold">Asign New Permission</label> <br>
                                            <select class="select2"  name="permissions" id="permissions" autocomplete="permissions-name">
                                                @foreach ($permissions as $permission)
                                                    <option value="{{$permission->name}}">{{$permission->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('permissions')
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

                      <!-- Permission Assign -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection

