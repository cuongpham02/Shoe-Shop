@extends('admin_layout')
@section('admin_conten')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Role
                </header>

                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{route('admin.roles.update',$role->id)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Role</label><span style="color:red;"> *</span>
                                <input type="text" name="role_name" value="{{ request('role_name',old('role_name')) ?? $role->role_name }}" class="form-control" placeholder="Tên roles">
                            </div>
                            @if ($errors->has('role_name'))
                                <p style="color:red;">{{$errors->first('role_name') }}</p>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Role</label><span style="color:red;"> *</span>
                                <input type="text" name="desc" value="{{ request('desc',old('desc')) ?? $role->desc}}" class="form-control" placeholder="Tên roles">
                            </div>
                            @if ($errors->has('desc'))
                                <p style="color:red;">{{$errors->first('desc') }}</p>
                            @endif
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input {{$roles_permissions->contains($permission->id) ? 'checked' : ''}}
                                           type="checkbox"
                                           class="form-check-input" name="permissions[]" value="{{ $permission->id }}">
                                    <label class="form-check-label" >{{ $permission->name }}</label>
                                </div>
                            @endforeach
                            <button type="submit" name="add_roles" class="btn btn-info">Update roles</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
@endsection
