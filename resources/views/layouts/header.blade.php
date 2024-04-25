<style>
    .count-item-cart {
        border-radius: 50%;
        color: white;
        width: 20px;
        height: 20px;
        background-color: orange;
        position: relative;
        top: -10px;
        left: -5px;
    }

    .count-item-cart {
        display: inline-block;
        text-align: center;
        line-height: 20px;
    }
</style>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <img src="../../images/icon.png" class="me-1" alt="" width="30px" height="25px">
                        <a class="navbar-brand" href="/">Wonder Vista Fashion</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control form-search" type="search" placeholder="Search" aria-label="Search">
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container-xl">
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
                    <li class="nav-item dropdown flex-fill">
                        <a class="nav-link dropdown-toggle dropdown-toggle-btn" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            COLLECTION
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Áo Thun</a></li>
                            <li><a class="dropdown-item" href="#">Áo Polo</a></li>
                            <li><a class="dropdown-item" href="#">Áo Khoác</a></li>
                            <li><a class="dropdown-item" href="#">Quần Short</a></li>
                            <li><a class="dropdown-item" href="#">Quần tây</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sơ Mi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item flex-fill">
                        <a href="contact" class="nav-link">CONTACT</a>
                    </li>
                    <li class="nav-item flex-fill">
                        <a href="about" class="nav-link">ABOUT US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</header>
