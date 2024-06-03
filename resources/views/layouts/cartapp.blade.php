<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="{{ asset('css/stylecart.css') }}">
</head>

<body>
    @include('layouts.header')

    <main>
        @yield('main')
    </main>

    @include('layouts.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/node_modules/slick-carousel/slick/slick.min.js"></script>
    <link rel="stylesheet" href="../../js/javascript.js">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var prices = document.querySelectorAll(".total-price, .money, .total-price-sale, .total-price-cart");

            prices.forEach(function(price) {
                var number = parseInt(price.innerHTML);

                var formattedPrice = number.toLocaleString();

                console.log(formattedPrice)

                price.innerHTML = formattedPrice + "₫";
            });
        });
        
    </script>
</body>

</html>