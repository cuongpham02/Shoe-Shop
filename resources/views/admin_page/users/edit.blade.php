@extends('admin_layout')
@section('admin_conten')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update user
                </header>

                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{route('update-users-new',$edit_user->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label >Tên users</label><span style="color:red;"> *</span>
                                <input type="text" name="name" value="{{ $edit_user->name }}" class="form-control" placeholder="Tên danh mục">
                            </div>

                            @if ($errors->has('name'))
                                <p style="color:red;">{{$errors->first('name') }}</p>
                            @endif

                            <div class="form-group">
                                <label >Email</label><span style="color:red;"> *</span>
                                <input type="email" name="email" value="{{ $edit_user->email }}" class="form-control"  placeholder="email">
                            </div>

                            @if ($errors->has('email'))
                                <p style="color:red;">{{$errors->first('email') }}</p>
                            @endif

                            <div class="form-group">
                                <label >Phone</label>
                                <input type="number" name="phone" value="{{ $edit_user->phone }}" class="form-control"  placeholder="Slug">
                                <!-- </div>
                                    <div class="form-group">
                                    <label >Password</label><span style="color:red;"> *</span>
                                    <input type="password" name="password" value="{{$edit_user->password}}" class="form-control" placeholder="password">
                                </div> -->

                                <!-- @if ($errors->has('password'))
                                    <p style="color:red;">{{$errors->first('password') }}</p>
                                @endif -->
                                <select class="form-control" style="margin-bottom: 20px;width: 200px;" name="roles[]" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option
                                            {{ $uses_roles->contains($role->id) ? 'selected' : '' }}
                                            value="{{ $role->id }}">
                                            {{ $role->roles_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" name="update_user" class="btn btn-info">update user</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
@endsection
