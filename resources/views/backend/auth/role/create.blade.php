@extends('backend.master')
@section('title')Role Create @endsection
@section('content')
<div class="main-content">
    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card card-primary">
            <form class="form p-2" action="{{Route('admin.roles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5>Ctreate New Role</h5>
                        <div class="">
                            <a href="{{Route('admin.roles.index')}}"><i class="material-icons text-white rounded-circle bg-primary p-1">keyboard_backspace</i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body pb-0">
                            <div class="form-group">
                              <label style="margin-left:0px!important;">Role Name</label>
                              <input type="text" id="name" style="margin-left:0px!important;" name="name" class="form-control ms-0" required="">
                              @error('name')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>

                            <div class=" mt-4 mb-4">
                                <h6 class="fw-bold" style="font-weight:bold;">Permissions</h6>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="checkbox" id="checkpermissionAll">
                                    <label class="form-check-label" for="checkpermissionAll">
                                        All
                                    </label>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        @php $i = 1; @endphp
                                        @foreach ($permission_groups as $group)
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                        <label class="form-check-label">{{ $group->name }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-8 role-{{ $i }}-management-checkbox">
                                                    @php
                                                        $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                                        $j = 1;
                                                    @endphp
                                                    @foreach ($permissions as $permission)
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                            <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                        @php  $j++; @endphp
                                                    @endforeach
                                                    <br>
                                                </div>
                                            </div>
                                            @php  $i++; @endphp
                                            <hr class="mb-4">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
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
@endsection

@section('script')
  <script>
    $("#checkpermissionAll").click(function(){
      if($(this).is(':checked')){
        //check all the checkbox
        $('input[type=checkbox]').prop('checked', true);
      }else{
        //uncheck all the checkbox
        $('input[type=checkbox]').prop('checked', false);
      }
    });

    function checkPermissionByGroup(className, checkThis){
      const groupIdName = $("#"+checkThis.id);
      const classCheckBox =  $('.'+className+' input');

      if(groupIdName.is(':checked')){
        //check all the checkbox
        classCheckBox.prop('checked', true);
      }else{
        //uncheck all the checkbox
        classCheckBox.prop('checked', false);
      }
    }
  </script>
@endsection





















