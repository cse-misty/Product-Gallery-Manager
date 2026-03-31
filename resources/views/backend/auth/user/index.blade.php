@extends('backend.master')
@section('title')User List - Admin-Panel @endsection
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <h5>User List</h5>
              <div class="text-end">
                @can('user_create')
                    <a href="{{Route('admin.users.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New User</a>
                @endcan
              </div>
            </div>
              <div class="table-responsive">
                <table class="table table-striped border-bottom-none" id="table-1">
                    <thead>
                        <tr>
                          <th class="text-center">
                            #
                          </th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $key => $users)
                        <tr>
                          <td> {{$key+1}} </td>
                          <td>{{$users->name}}</td>
                          <td>
                              @if (empty($users->image))
                               <img alt="image" src="{{asset('backend/img/user')}}/bdcham.png" width="35">
                               @endif
                               @if (!empty($users->image))
                               <img alt="image" src="{{asset('backend/img/user')}}/{{ $users->image }}" width="35">
                               @endif
                          </td>
                          <td class="d-none d-md-block pt-4">{{$users->email}}</td>


                          <td class="">
                            @if ($users->status == 1)
                                <img alt="image" src="{{asset('backend/img')}}/on.png" width="50">
                            @endif
                            @if ($users->status == 2)
                                <img alt="image" src="{{asset('backend/img')}}/of.png" width="50">
                            @endif
                          </td>

                          <td>
                            <div class="d-flex">
                              @can('user_view')
                                <a href="{{Route('admin.users.show', $users->id)}}" class="btn btn-primary mr-1"><i class="far fa-eye"></i></a>
                              @endcan
                              @can('user_edit')
                                <a href="{{Route('admin.users.edit', $users->id)}}" class="btn btn-warning mr-1"><i class="fas fa-edit"></i></a>
                              @endcan
                              @can('user_delete')
                                <a class="btn btn-danger" onclick="confirm_delete_backend({{$users->id}})">
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                                <form action="{{route('admin.users.destroy', $users->id) }}"
                                    id="delete_form_{{ $users->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
                              @endcan
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

