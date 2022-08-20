
@extends('admin_layout')
@section('admin_conten')
<div class="panel-heading">
      Liệt Kê Danh Mục Sản Phẩm
    </div>
</div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <a href="{{ route('Admin.create-category') }}" class="btn btn-sm btn-success">Thêm Danh Mục</a>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
        <form method="get">
          <div class="input-group">
            <input type="text" class="input-sm form-control"  name="search" value="{{ request('search') }}" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit">Go!</button>
            </span>
          </div>
        </form>

        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
              <?php
                $message=Session::get('message');
                if ($message) {
                  echo '<span  class="textalert">'.$message.'</span>';
                  Session::put('message',null);
                 }
                 $i=1;
               ?>
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                STT
              </label>
            </th>
            <th>Tên danh mục</th>
            <th>Mô tả danh mục</th>
            <th>Ngày thêm</th>
            <th>Ẩn/Hiện</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
           @foreach ($all_category as $key => $cate_pro)
          <tr>
            <td><?= $i++;?></td>
            <td>{{$cate_pro->name}}</td>
            <td>{!! $cate_pro->desc !!}</td>
            <td><span class="text-ellipsis">{{$cate_pro->created_at}}</span></td>
            <td></td>

            <!-- Sửa và Xóa -->
            <td>
              <a href="{{URL::to('/Admin/category/edit-category/'.$cate_pro->id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn muốn xóa danh mục này?')" href="{{URL::to('/Admin/category/delete-category/'.$cate_pro->id)}}">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
            <!-- end Sửa và Xóa -->
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection
