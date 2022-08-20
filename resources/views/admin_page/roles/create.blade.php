@extends('admin_layout')
@section('admin_conten')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Role
                </header>

                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{route('admin.roles.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="role_name">Name Role</label><span style="color:red;"> *</span>
                                <input type="text" name="role_name" id="role_name" value="{{ request('name_role',old('role_name')) }}" class="form-control" placeholder="Name Role">
                            </div>
                            @if ($errors->has('role_name'))
                                <p style="color:red;">{{$errors->first('role_name') }}</p>
                            @endif
                            <div class="form-group">
                                <label for="desc">Description Role</label><span style="color:red;"> *</span>
                                <input type="text" name="desc" id="desc" value="{{ request('desc',old('desc')) }}" class="form-control" placeholder="Description Role">
                            </div>
                            @if ($errors->has('desc'))
                                <p style="color:red;">{{$errors->first('desc') }}</p>
                            @endif
                            @foreach($permission as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->id}}">
                                    <label for="exampleCheck">{{$permission->name}}</label>
                                </div>
                            @endforeach
                            <button type="submit" name="add_roles" class="btn btn-info">Add Role</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
@endsection
