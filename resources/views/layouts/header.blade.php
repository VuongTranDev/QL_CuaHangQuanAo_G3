<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex">
                <img src="../../images/icon.png" class="me-1" alt="" width="30px" height="25px">
                <a class="navbar-brand" href="/">Wonder Vista Fashion</a>
                <ul class="navbar-nav me-auto justify-content-end">
                    <li class="nav-item">
                        <div class="search-container">
                            <div class="search-container">
                                <input type="text" id="searchInput" class="form-control search" placeholder="Search">
                                <button class="border-0 ic-search" type="button" id="searchButton"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="/admin_login" class="me-3">
                            <i class="fas fa-shopping-basket cart-item"> <span class="count-item-cart">1</span></i>
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
                                    <a class="dropdown-item" href="#">Đơn mua</a>
                                    <a class="dropdown-item" href="/logoutUser">Đăng xuất</a>
                                </div>
                            @endif
                        </div>
                    </li>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            handleSearchForm();

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
                                    e.preventDefault(); // Prevent form submission on first click
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
                                    // Xử lý dữ liệu trả về
                                    var newUrl = "{{ route('products.search') }}" + '?search_query=' + encodeURIComponent(
                                        searchQuery);
                                    window.history.pushState({
                                        path: newUrl
                                    }, '', newUrl);
                                    window.location.reload();
                                },
                                error: function(xhr) {
                                    // Xử lý lỗi
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    </script>
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
                        <a class="nav-link" href="#">BEST SELLER</a>
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
                </ul>
            </div>
        </div>
    </nav>
</header>
