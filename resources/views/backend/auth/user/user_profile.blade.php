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
                    @if (empty(Auth::user()->image))
                        <img src="{{asset('backend/img/user')}}/bdcham.png" width="200" style="border-radius: 50%" height="auto" class="img-fluid mt-3 mb-3" alt="Profile" id="output">
                        @endif
                        @if (!empty(Auth::user()->image))
                        <img src="{{asset('backend/img/user')}}/{{ Auth::user()->image }}" width="200" style="border-radius: 50%" height="auto" class="img-fluid mt-3 mb-3" alt="Profile" id="output">
                        @endif
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#">{{ Auth::user()->name}}</a>
                      </div>
                      <div class="author-box-job">{{ Auth::user()->job}}</div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-description">
                        <p>
                        {{ Auth::user()->about}}
                        </p>
                      </div>
                      <div class="mb-2 mt-3">
                        <div class="text-small font-weight-bold">Follow Hasan On</div>
                      </div>
                      <a href="{{ Auth::user()->facebook}}" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="{{ Auth::user()->twitter}}" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a href="{{ Auth::user()->instagram}}" class="btn btn-social-icon mr-1 btn-instagram">
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
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#edit" role="tab"
                          aria-selected="false">Edit Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#role" role="tab"
                          aria-selected="false">Role</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#permission" role="tab"
                          aria-selected="false">Permission</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                      <h5 class="card-title">About</h5>
                        <p class="small fst-italic">{{ Auth::user()->about }}</p>

                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Company</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->company }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Job</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->job }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Country</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->country }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Address</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->address }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->phone }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">- {{ Auth::user()->email }}</div>
                        </div>
                      </div>

                      <!-- Edit Profile -->
                      <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="profile-tab2">
                          <div class="user_role">
                              <h5 class="my-2">Edit</h5>
                              <div class="py-3 d-flex">
                              <form  action="{{Route('admin.users.update', Auth::user()->id)}}" style="width:100%;" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="rback" value="2">
                                <div class="row mb-3">
                                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                  <div class="col-md-8 col-lg-9">
                                    @if (empty(Auth::user()->image))
                                    <img src="{{asset('backend/img/user')}}/bdcham.png" width="200" height="auto" class="img-fluid" alt="Profile" id="output">
                                    @endif
                                    @if (!empty(Auth::user()->image))
                                    <img src="{{asset('backend/img/user')}}/{{ Auth::user()->image }}" width="200" height="auto" class="img-fluid" alt="Profile" id="output">
                                    @endif

                                    <div class="pt-2">
                                    <input class="form-control my-2" id="image" name="image" value="" type="file" accept="image/*" onchange="loadFile(event)"></i>
                                      <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                                    </div>
                                  </div>
                                </div>
                                @php
                                  $name = explode(" ", Auth::user()->name);
                                  $lastname = array_pop($name);
                                  $firstname = implode(" ", $name);
                                @endphp
                                <div class="row mb-3">
                                  <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="first_name" type="text" class="form-control" id="first_name" value="{{ $firstname }}">
                                    @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $lastname }}">
                                    @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                  <div class="col-md-8 col-lg-9">
                                    <textarea name="about" class="form-control" id="about" style="height: 100px">{{ Auth::user()->about }}</textarea>
                                  </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Status</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-control selectric rounded" name="status" id="status" required>
                                            <option value="1" {{ Auth::user()->status == 1 ? 'selected': ''}}>Active</option>
                                            <option value="2" {{ Auth::user()->status == 2 ? 'selected':''}}>De-Active</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="company" type="text" class="form-control" id="company" value="{{ Auth::user()->company }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="job" type="text" class="form-control" id="Job" value="{{ Auth::user()->job }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="country" type="text" class="form-control" id="Country" value="{{ Auth::user()->country }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="address" type="text" class="form-control" id="Address" value="{{ Auth::user()->address }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="phone" type="text" class="form-control" id="Phone" value="{{ Auth::user()->phone }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="input-group">

                                            <input name="password" type="password" class="form-control" id="password" value="{{ Auth::user()->normalpass }}">
                                            <button type="button" style="margin-left: 10px;" class="btn btn-outline-secondary" id="togglePassword">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="twitter" type="text" class="form-control" id="Twitter" value="{{ Auth::user()->twitter }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="facebook" type="text" class="form-control" id="Facebook" value="{{ Auth::user()->facebook }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="instagram" type="text" class="form-control" id="Instagram" value="{{ Auth::user()->instagram }}">
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                                  <div class="col-md-8 col-lg-9">
                                    <input name="linkedin" type="text" class="form-control" id="Linkedin" value="{{ Auth::user()->linkedin }}">
                                  </div>
                                </div>

                                <div class="text-center">
                                  <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                              </form>
                              </div>
                          </div>
                      </div>
                      <!-- Edit Profile -->

                      <!-- Role assign -->

                      <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="profile-tab3">
                          <div class="user_role">
                              <h5 class="my-2">Role</h5>
                              <div class="py-3 d-flex">
                                  @foreach (Auth::user()->roles as $role)
                                    @php
                                      $ra = rand(1,3)
                                    @endphp
                                    <div class="col-3">
                                        <span class="badge btcolor{{$ra}} badge-shadow m-2">{{ $role->name }}</span>
                                    </div>
                                    @endforeach
                              </div>
                          </div>
                      </div>

                    <!-- Permission -->
                    <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="profile-tab4">
                        <div class="user_role">
                            <h5 class="my-2">Permissions</h5>
                            <div class="py-3" style="display: flow-root;">
                                @foreach ($userpermissions as $permission)
                                  @php
                                    $ra = rand(1,3)
                                  @endphp
                                  <div class="col-12">
                                      <span style="float:left;" class="badge btcolor{{$ra}} badge-shadow m-2">{{ $permission->name }}</span>
                                  </div>
                                @endforeach
                                @if (Auth::user()->permissions)
                                    @foreach (Auth::user()->permissions as $user_permission)
                                    @php
                                        $ra = rand(1,3)
                                    @endphp
                                    <div class="col-12">
                                      <span style="float:left;" class="badge btcolor{{$ra}} badge-shadow m-2">{{ $user_permission->name }}</span>
                                    </div>
                                    @endforeach
                                @endif
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

      <script>
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });
    </script>
@endsection

