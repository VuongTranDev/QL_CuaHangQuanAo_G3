<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex" >
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <img src="../../images/icon.png" class="me-1" alt="" width="30px" height="25px">
                        <a class="navbar-brand" href="/">Wonder Vista Fashion</a>
                    </li>
                </ul>
                <form class="form-search-group" role="search" action="{{ route('products.search', ['search_query' => request()->input('search_query')]) }}" method="GET">
                    <input class="form-control form-search" name="search_query" placeholder="Search" aria-label="Search">
                    <button class="border-0 ic-search" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <a href="#" class="me-4">
                    <i class="far fa-user"> Vương Trần</i>
                </a>
                <a href="/">
                    <i class="fas fa-shopping-basket"> <span class="count-item-cart">1</span></i>
                </a>
            </div>
        </div>
    </nav>
    <hr style="margin: 0; border: 2px solid;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <button class="navbar-toggler mt-2 mb-2 ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <li><a class="dropdown-item" href="{{ route('products.productsByType', ['tenloai' => 'Áo thun']) }}">Áo Thun</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.productsByType', ['tenloai' => 'Áo Sơ Mi']) }}">Áo Sơ Mi</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.productsByType', ['tenloai' => 'Hoodie']) }}">Áo Hoodie</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.productsByType', ['tenloai' => 'Sweater']) }}">Áo Sweater</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.productsByType', ['tenloai' => 'Quần Jean']) }}">Quần Jeans</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.productsByType', ['tenloai' => 'Quần Short']) }}">Quần Short</a></li>

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
