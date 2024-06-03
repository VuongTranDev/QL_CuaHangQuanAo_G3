<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wonder Vista</title>
    <link rel="shortcut icon" type="image/png" href="../../images/icon.png">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/node_modules/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="/node_modules/slick-carousel/slick/slick-theme.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="{{ asset('../css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    @include('layouts.header')

    <main>
        @yield('renderBody')
        <div>
            <button id="backToTop" title="Back to top" class="btn-back-to-top button__back-to-top show">
                <div class="icon-up">
                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M416 352c-8.188 0-16.38-3.125-22.62-9.375L224 173.3l-169.4 169.4c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25C432.4 348.9 424.2 352 416 352z">
                        </path>
                    </svg>
                </div>
                <strong>Lên đầu</strong>
            </button>
            <a id="btnZaloChat" target="_blank" rel="noopener nofollow"
                href="https://id.zalo.me/account?continue=https://chat.zalo.me" class="btn-zalo-chat button__zalo">
                <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:80/plain/https://cellphones.com.vn/media/icons/icon-zalo.png"
                    alt="Zalo Button">
            </a>
        </div>

        <div class="social" data-aos="fade-up">
            <ul>
                <li><a href="https://www.facebook.com/" title="Facebook" target="_blank" class="blue"><span><i
                                class="fab fa-facebook"></i></span></a></li>
                <li><a href="https://www.youtube.com/" title="Youtube" target="_blank" class="red"><span><i
                                class="fab fa-youtube"></i></span></a></li>
                <li><a href="https://www.instagram.com/" title="Instagram" target="_blank" class="rainbow"><span><i
                                class="fab fa-instagram"></i></span></a></li>
                <li><a href="https://www.tiktok.com/" title="Tiktok" target="_blank" class="black"><span><i
                                class="fab fa-tiktok"></i></span></a></li>
            </ul>
        </div>
    </main>

    @include('layouts.footer')
</body>


<script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="/node_modules/slick-carousel/slick/slick.min.js"></script>
<link rel="stylesheet" href="../../js/javascript.js">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    AOS.init();
    document.addEventListener('DOMContentLoaded', function() {
        var backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>



</html>
