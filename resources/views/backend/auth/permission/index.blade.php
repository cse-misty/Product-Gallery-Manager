@extends('backend.master')
@section('title')Permission List - Admin-Panel @endsection
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <h5>Permission List</h5>
              <div class="text-end">
                @can('permission_create')
                    <a href="{{Route('admin.permissions.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Permission </a>
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
                          <th>Permission Name</th>
                          <th></th>
                          <th></th>
                          <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($permission as $key => $permission)
                        <tr>
                          <td> {{$key+1}} </td>
                          <td>{{$permission->name}}</td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="d-flex">
                              @can('permission_view')
                                <a href="{{Route('admin.permissions.show', $permission->id)}}" class="btn btn-primary mr-1"><i class="far fa-eye"></i></a>
                              @endcan
                              @can('permission_edit')
                                <a href="{{Route('admin.permissions.edit', $permission->id)}}" class="btn btn-warning mr-1"><i class="fas fa-edit"></i></a>
                              @endcan
                              @can('permission_delete')
                                <a class="btn btn-danger" onclick="confirm_delete_backend({{$permission->id}})">
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                                <form action="{{route('admin.permissions.destroy', $permission->id) }}"
                                    id="delete_form_{{ $permission->id }}" method="POST">
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



