@extends('backend.master')
@section('title') Role View - Admin Panel @endsection
@section('content') 


<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Role Name</h4>
                    <hr>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                      <li class="media">
                        <div class="media-body">
                          <div class="" style="font-weight:bolder; font-size:25px;">{{$roles->name}}</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                          aria-selected="true">Permissions</a>
                      </li>
                      <li class="nav-item">
                        <div class="" style="margin-left: 20px;">
                          <a href="{{Route('admin.roles.index')}}"><i class="material-icons text-white rounded-circle bg-info p-1">keyboard_backspace</i></a>
                        </div>
                      </li>
                    </ul>
                   
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                        <div class="p-3">
                            @if ($roles->permissions)
                                @foreach ($roles->permissions as $role_permission)
                                @php
                                  $ra = rand(1,3)
                                @endphp
                                    <form style="float:left;" class="d-block" action="{{Route('admin.roles.permissions.revoke', [$roles->id, $role_permission->id])}}" onsubmit="return confirm('Are you sure');" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button style="float:left;" class="badge btcolor{{$ra}} badge-shadow mb-1 ms-2" type="submit">{{$role_permission->name}}</button>
                                    </form>
                                @endforeach
                            @endif
                          </div>
                          

                          <!-- New Permission Assign -->
                          <!-- Assign Permissions -->
                          <div class="col-12 col-md-6 col-lg-12 pt-4">
                            <div class="card">
                              <div class="card-header">
                                <h4>New Permission Assign</h4>
                              </div>
                              <div class="card-body">
                                <div class="form-group">
                                      <form class="form p-2" action="{{route('admin.roles.permissions', $roles->id)}}" method="post">
                                      @csrf
                                      <label for="permissions fw-bold">Asign New Permission</label> <br>
                                      <select class="form-control select2" name="permissions" id="permissions" autocomplete="permission-name">
                                          @foreach ($permissions as $permission)
                                              <option value="{{$permission->name}}">{{$permission->name}}</option>
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
                      <!-- Assign Permissions -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection



