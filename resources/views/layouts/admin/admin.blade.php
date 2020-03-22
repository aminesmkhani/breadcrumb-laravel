<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل مدیریت</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
<!-- Main -->
    <div class="container-fluid">
        <!-- Admin Side bar Area -->
            <div class="admin_sidebar">
                <!-- Change size side bar dropdown-->
                <span class="fa fa-bars" id="sidebarToggle" title="تغییر سایز"></span>
                <!--###-->
                <ul id="sidebar_menu">
                    <li>
                        <a>
                            <span class="fa fa-shopping-cart"></span>
                            <span class="sidebar_li_text">محصولات</span>
                            <span class="fa fa-angle-left"></span>
                        </a>
                        <!-- Child menu for admin li  -->
                        <div class="child_menu">
                            <a href="">مدیریت محصولات</a>
                            <a href="">افزودن محصول</a>
                            <a href="">مدیریت دسته ها</a>
                            <a href="">افزودن دسته</a>
                        </div>
                        <!--##-->
                    </li>

                    <li>
                        <a>
                            <span class="fa fa-sliders"></span>
                            <span class="sidebar_li_text">اسلایدر</span>
                            <span class="fa fa-angle-left"></span>
                        </a>
                        <!-- Child menu for admin li  -->
                        <div class="child_menu">
                            <a href="">مدیریت اسلایدر ها</a>
                            <a href="">افزودن اسلایدر</a>
                        </div>
                        <!--##-->
                    </li>
                </ul>
            </div>
        <!--### -->
        <!-- Admin Content Area -->
        <div class="admin_content">
            <!--Main Content Area-->
                <div class="content_box" id="app">
                    @yield('content')
                </div>
            <!--### -->
        </div>
        <!--### -->
    </div>
<!-- Alert Message Area -->
<div class="message_div">
    <div class="message_box">
        <p id="msg"></p>
        <a  class="alert alert-success" onclick="delete_row()">بله</a>
        <a  class="alert alert-danger" onclick="hide_box()">خیر</a>
    </div>
</div>
<!--### -->
<!-- Main -->


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>
