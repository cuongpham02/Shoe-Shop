@extends('admin_layout')
@section('admin_conten')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm user
                </header>

                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{route('save-users-new')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label >Tên users</label><span style="color:red;"> *</span>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Tên">
                            </div>

                            @if ($errors->has('name'))
                                <p style="color:red;">{{$errors->first('name') }}</p>
                            @endif

                            <div class="form-group">
                                <label >Email</label><span style="color:red;"> *</span>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"  placeholder="email">
                            </div>

                            @if ($errors->has('email'))
                                <p style="color:red;">{{$errors->first('email') }}</p>
                            @endif

                            <div class="form-group">
                                <label >Phone</label><span style="color:red;"> *</span>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"  placeholder="Slug">
                            </div>
                            @if ($errors->has('phone'))
                                <p style="color:red;">{{$errors->first('phone') }}</p>
                            @endif
                            <div class="form-group">
                                <label >Password</label><span style="color:red;"> *</span>
                                <input type="password" name="password" class="form-control" placeholder="Slug">
                            </div>
                            <!-- <div class="form-group">
                                <label for="confirm_password">Confirm-password</label><span style="color:red;"> *</span>
                                <input type="password" class="form-control" placeholder="re-Enter pass" name="confirm_password" required>
                            </div> -->

                            @if ($errors->has('password'))
                                <p style="color:red;">{{$errors->first('password') }}</p>
                            @endif
                            <select class="form-control" style="margin-bottom: 20px;width: 200px;" name="roles[]" multiple="multiple">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->roles_name }}</option>
                                @endforeach

                            </select>
                            <button type="submit" name="add_users" class="btn btn-info">Thêm users</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
@endsection
