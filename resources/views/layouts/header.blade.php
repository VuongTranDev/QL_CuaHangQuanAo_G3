<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex nav-header-local">
                <img src="../../images/icon.png" class="me-1" alt="" width="30px" height="25px">
                <a class="navbar-brand" href="/">Wonder Vista Fashion</a>
                <ul class="navbar-nav me-auto justify-content-end">
                    <li class="nav-item">
                        <div class="search-container">
                            <input type="text" id="searchInput" class="form-control search" value="{{Session::get('search_query')}}" placeholder="Search">
                            <button class="border-0 ic-search" type="button" id="searchButton"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="/cart/index">
                            <i class="fas fa-shopping-basket"> <span class="count-item-cart">
                                    <?php
                                    $sogiohang = Session::get('sogiohang');
                                    if ($sogiohang) {
                                        echo $sogiohang;
                                    }
                                    else{
                                        echo 0;
                                    }
                                    ?>
                                </span></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            @if (Session::get('makh') == null)
                                <a href="/admin_login">
                                    <i class="far fa-user">
                                        <?php
                                        $name = Session::get('ten');
                                        if ($name) {
                                            echo $name;
                                        }
                                        ?>
                                    </i>
                                </a>
                            @else
                                <a href="#" type="button" id="userDropdown" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="far fa-user">
                                        <?php
                                        $name = Session::get('ten');
                                        if ($name) {
                                            echo $name;
                                        }
                                        ?>
                                    </i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-user" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="/profile">Tài khoản của tôi</a>
                                    <a class="dropdown-item" href="/donmua">Đơn mua</a>
                                    <a class="dropdown-item" href="/logoutUser">Đăng xuất</a>
                                </div>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <hr style="margin: 0; border: 2px solid;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <button class="navbar-toggler mt-2 mb-2 ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item flex-fill">
                        <a class="nav-link" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item flex-fill">
                        <a class="nav-link" href="/allProducts">ALL PRODUCTS</a>
                    </li>
                    <li class="nav-item flex-fill">
                        <a class="nav-link" href="/allProducts">BEST SELLER</a>
                    </li>
                    <li class="logo-nav">
                        <a class="nav-link" href="/"><img class="img-logo" src="../../images/icon.png"
                                alt=""></a>
                    </li>
                    <li class="nav-item dropdown flex-fill d-grid">
                        <a class="nav-link dropdown-toggle dropdown-toggle-btn" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            COLLECTION
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="{{ route('products.productsByType', ['tenloai' => 'Áo thun']) }}">Áo Thun</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('products.productsByType', ['tenloai' => 'Áo Sơ Mi']) }}">Áo Sơ
                                    Mi</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('products.productsByType', ['tenloai' => 'Hoodie']) }}">Áo Hoodie</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('products.productsByType', ['tenloai' => 'Sweater']) }}">Áo
                                    Sweater</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('products.productsByType', ['tenloai' => 'Quần Jean']) }}">Quần
                                    Jeans</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('products.productsByType', ['tenloai' => 'Quần Short']) }}">Quần
                                    Short</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="/allProducts">Tất Cả Sản Phẩm</a></li>

                    </li>
                </ul>
                </li>
                <li class="nav-item flex-fill">
                    <a href="/contact" class="nav-link">CONTACT</a>
                </li>
                <li class="nav-item flex-fill">
                    <a href="/about" class="nav-link">ABOUT US</a>
                </li>
                <li class="nav-item flex-fill nav-search-mobile">
                    <div class="search-container2">
                        <input type="text" id="searchInput2" class="form-control search2" placeholder="Search">
                        <button class="border-0 ic-search" type="button" id="searchButton2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </li>

            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        handleSearchForm();
        handleSearchForm2();

        const searchInput2 = document.getElementById('searchInput2');
        searchInput2.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {

                submitSearch2();
            }
        });

        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                submitSearch();
            }
        });
    });

    function handleSearchForm() {
        const searchInput = document.querySelector('.search');
        const searchIcon = document.querySelector('.ic-search');

        searchIcon.addEventListener('click', function(e) {
            if (!searchInput.classList.contains('expanded')) {
                e.preventDefault();
                searchInput.classList.add('expanded');
                searchInput.focus();
            }
        });

        searchInput.addEventListener('blur', function() {
            if (searchInput.value === '') {
                searchInput.classList.remove('expanded');
            }
        });
    }

    function submitSearch() {
        var searchQuery = $('#searchInput').val();
        $.ajax({
            url: "{{ route('products.search') }}",
            type: "GET",
            data: {
                search_query: searchQuery
            },
            success: function(response) {
                var newUrl = "{{ route('products.search') }}" + '?search_query=' + encodeURIComponent(
                    searchQuery);
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
                window.location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function handleSearchForm2() {
        const searchInput2 = document.getElementById('searchInput2');
        const searchIcon2 = document.getElementById('searchButton2');

        searchIcon2.addEventListener('click', function(e) {
            if (!searchInput2.classList.contains('expanded')) {
                e.preventDefault();
                searchInput2.classList.add('expanded');
                searchInput2.focus();
            }
        });

        searchInput2.addEventListener('blur', function() {
            if (searchInput2.value === '') {
                searchInput2.classList.remove('expanded');
            }
        });
    }

    function submitSearch2() {
        var searchQuery2 = $('#searchInput2').val();
        $.ajax({
            url: "{{ route('products.search') }}",
            type: "GET",
            data: {
                search_query: searchQuery2
            },
            success: function(response) {
                var newUrl = "{{ route('products.search') }}" + '?search_query=' + encodeURIComponent(
                    searchQuery2);
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
                window.location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
