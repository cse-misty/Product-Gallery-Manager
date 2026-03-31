@extends('backend.master')
@section('title')Role List - Admin-Panel @endsection
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <h5>Role List</h5>
              <div class="text-end">
                @can('role_create')
                    <a href="{{Route('admin.roles.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Role</a>
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
                          <th>Role Name</th>
                          <th class="text-center">Permission</th>
                          <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $key => $roles)
                        <tr>
                          <td> {{$key+1}} </td>
                          <td>{{$roles->name}}</td>

                          <td class="text-center">
                            @if ($roles->permissions)
                                @foreach ($roles->permissions as $role_permission)
                                @php
                                  $ra = rand(1,3)
                                @endphp
                                    <div class="badge btcolor{{$ra}} badge-shadow mb-1">{{$role_permission->name}}</div>
                                @endforeach
                            @endif
                          </td>

                          <td>
                            <div class="d-flex">
                              @can('role_view')
                                <a href="{{Route('admin.roles.show', $roles->id)}}" class="btn btn-primary mr-1"><i class="far fa-eye"></i></a>
                              @endcan
                              @can('role_edit')
                                <a href="{{Route('admin.roles.edit', $roles->id)}}" class="btn btn-warning mr-1"><i class="fas fa-edit"></i></a>
                              @endcan
                              @can('role_delete')
                                <a class="btn btn-danger" onclick="confirm_delete_backend({{$roles->id}})">
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                                <form action="{{route('admin.roles.destroy', $roles->id) }}"
                                    id="delete_form_{{ $roles->id }}" method="POST">
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
