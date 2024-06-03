@extends('layouts.app')
@section('renderBody')
    <style>
        

        @media (max-width: 768px) {
            .nav-control-left,
            article {
                width: 100%;
                height: auto;
            }

            #right-banner {
                display: none;
            }
        }
    </style>
    <div class="container-fluid">
        <section>
            <nav class="nav-control-left">
                <ul>
                    <li><a href="/profile">Tài khoản của tôi</a></li>
                    <li><a href="/address">Địa chỉ</a></li>
                    <li><a href="/donmua">Đơn mua</a></li>
                    <li><a href="#">Đổi mật khẩu</a></li>
                    <li><a href="#">Ngân hàng</a></li>
                    <li><a href="#">Cài đặt thông báo</a></li>
                </ul>
            </nav>

            <article>
                <div class="row">
                    <div class="col-12 col-lg-7">
                        @yield('renderProfile')
                    </div>
                    <div style="float: right;" class="col-5" align="center" id="right-banner">
                        <div style="display: flex">
                            <img src="{{ URL('images/about3.png') }}" alt="" width="33%" height="auto">
                            <img src="{{ URL('images/about5.png') }}" alt="" width="33%" height="auto">
                            <img src="{{ URL('images/about2.png') }}" alt="" width="34%" height="auto">
                        </div>
                        <div style="display: flex">
                            <img src="{{ URL('images/about1.png') }}" alt="" width="50%" height="auto">
                            <img src="{{ URL('images/about4.png') }}" alt="" width="50%" height="auto">
                        </div>
                        <div style="display: flex">
                            <img src="{{ URL('images/about3.png') }}" alt="" width="33%" height="auto">
                            <img src="{{ URL('images/about5.png') }}" alt="" width="33%" height="auto">
                            <img src="{{ URL('images/about2.png') }}" alt="" width="34%" height="auto">
                        </div>
                        <div style="display: flex">
                            <img src="{{ URL('images/about1.png') }}" alt="" width="50%" height="auto">
                            <img src="{{ URL('images/about4.png') }}" alt="" width="50%" height="auto">
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var links = document.querySelectorAll(".nav-control-left ul li a");
            var currentPath = window.location.pathname;

            links.forEach(function(link) {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add("active");
                }
                link.addEventListener("click", function() {
                    localStorage.setItem("activeLink", this.getAttribute('href'));
                });
            });

            var activeLink = localStorage.getItem("activeLink");

            if (activeLink) {
                links.forEach(function(link) {
                    if (link.getAttribute('href') === activeLink) {
                        link.classList.add("active");
                    }
                });
            }
        });
    </script>
@endsection
