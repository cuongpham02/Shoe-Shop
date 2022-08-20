<!DOCTYPE html>
<head>
    <title>{{ $title ?? "Home" }}
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css'/>
    <link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css"/>
    <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('backend/js/morris.js')}}"></script>
    <style>
        #content {
            min-height: 1000px;
        }
    </style>
</head>
<body>
<section id="container">
    <!--header start-->
    @include('admin_page.layouts.header')
    <!--header end-->

    @include('admin_page.layouts.siderbar')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper" id="content">
            <!-- //market-->
            @yield('content')
            <!-- //market-->
        </section>
        <!-- footer -->
        @include('admin_page.layouts.footer')
        <!-- / footer -->
    </section>
    <!--main content end-->

    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $('#myTable').DataTable().reload();
    </script>
    <!-- File thư mục hình ảnh -->
    <script type="text/javascript">
        load_gallery();

        function load_gallery() {
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url: "{{url('/Admin/product/load-gallery-product')}}",
                method: "POST",
                data: {pro_id: pro_id, _token: _token},
                success: function (data) {
                    $('#gallery_load').html(data);
                }
            });
        }

        $('#file').change(function () {
            var error = '';
            var files = $('#file')[0].files;

            if (files.length > 5) {
                error += '<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
            } else if (files.length == '') {
                error += '<p>Bạn không được bỏ trống ảnh</p>';
            } else if (files.size > 2000000) {
                error += '<p>File ảnh không được lớn hơn 2MB</p>';
            }

            if (error == '') {

            } else {
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                return false;
            }

        });

        $(document).on('blur', '.edit_gal_name', function () {
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/Admin/product/update-name-gallery')}}",
                method: "POST",
                data: {gal_id: gal_id, gal_text: gal_text, _token: _token},
                success: function (data) {
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            });
        });

        $(document).on('click', '.delete-gallery', function () {
            var gal_id = $(this).data('gal_id');

            var _token = $('input[name="_token"]').val();
            if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                $.ajax({
                    url: "{{url('/Admin/product/delete-gallery')}}",
                    method: "POST",
                    data: {gal_id: gal_id, _token: _token},
                    success: function (data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                    }
                });
            }
        });

        $(document).on('change', '.file_image', function () {

            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-" + gal_id).files[0];

            var form_data = new FormData();

            form_data.append("file", document.getElementById("file-" + gal_id).files[0]);
            form_data.append("gal_id", gal_id);

            $.ajax({
                url: "{{url('/Admin/product/update-image-gallery')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
                }
            });

        });


    </script>

    <!-- duyệt và trả lời Comment -->
    <script type="text/javascript">
        $('.comment_duyet_btn').click(function () {
            var status = $(this).data('status');

            var id = $(this).data('comment_id');
            var product_id = $(this).attr('id');
            if (status == 0) {
                var alert = 'Thay đổi thành duyệt thành công';
            } else {
                var alert = 'Thay đổi thành bỏ duyệt thành công';
            }
            $.ajax({
                url: "{{url('/Admin/allow-comments')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {status: status, id: id, product_id: product_id},
                success: function (data) {
                    location.reload();
                    $('#notify_comment').html('<span class="text text-alert">' + alert + '</span>');
                }
            });
        });
        $('.btn-reply-comment').click(function () {
            var id = $(this).data('comment_id');
            var desc = $('.reply_comment_' + id).val();
            var product_id = $(this).data('product_id');
            $.ajax({
                url: "{{url('/Admin/reply-comment')}}",
                method: "POST",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {desc: desc, id: id, product_id: product_id},
                success: function (data) {
                    location.reload();
                    $('.reply_comment_' + id).val('');
                    $('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>');
                }
            });
        });
    </script>

@include('Admin.layouts_admin.js_template')

</body>
</html>
