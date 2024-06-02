function handleCarousel() {
    $('.carousel').carousel();
    $('.thumbnail:first').addClass('active-slide');

    $('.thumbnail').on('click', function () {
        var slideIndex = $(this).data('slide-to');
        $('#carouselExample').carousel(slideIndex);
        $('.thumbnail').removeClass('active-slide');

        $(this).addClass('active-slide');
    });

    $('#carouselExample').on('slid.bs.carousel', function (e) {
        var slideIndex = $('.carousel-item.active').index();
        $('.thumbnail').removeClass('active-slide');
        $('.thumbnail[data-slide-to="' + slideIndex + '"]').addClass('active-slide');
    });
}

function handleSort() {

}

$(document).ready(function () {
    handleCarousel();
});



// Hàm định dạng giá
function formatPriceElements() {
    var priceElements = document.querySelectorAll(".price-product, .price-detail-product, .save-price, .price-old");
    priceElements.forEach(function (element) {
        var gia = parseFloat(element.textContent);
        var formattedPrice = gia.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        element.textContent = formattedPrice;
    });
}

// Hàm xử lý sự kiện khi chọn kích thước
function handleSizeButtons() {
    var sizeButtons = document.querySelectorAll('.size-btn input[type="radio"]');
    sizeButtons.forEach(function (button) {
        button.addEventListener('change', function () {
            var selectedSize = document.querySelector('input[name="size"]:checked').value;
            var sizeLabels = document.querySelectorAll('.size-btn');
            sizeLabels.forEach(function (label) {
                label.style.border = "1px solid #ccc";
                label.style.background = "#fff";
            });
            this.parentNode.style.border = "2px solid #337ccf";
            this.parentNode.style.background = "#f0f0f0";
        });
    });
}

// Hàm xử lý sự kiện khi click vào liên kết "Hiển thị Bảng kích thước"
function handleSizeGuideLink() {
    var sizeGuideLink = document.getElementById('showSizeGuide');
    var sizeGuideBox = document.querySelector('.box-select-size');
    var groupSize = document.querySelector('.group-size');

    sizeGuideLink.addEventListener('click', function (event) {
        event.preventDefault();

        if (sizeGuideBox.style.display === 'none' || sizeGuideBox.style.display === '') {
            sizeGuideBox.style.display = 'block';
            groupSize.classList.remove('zoom-out');
            groupSize.classList.add('zoom-in');
        } else {
            groupSize.classList.remove('zoom-in');
            groupSize.classList.add('zoom-out');
            setTimeout(function () {
                sizeGuideBox.style.display = 'none';
            }, 300);
        }
    });
}



// Hàm xử lý sự kiện thay đổi số lượng
function handleQuantityButtons() {
    var minusBtn = document.querySelector('.minus-btn');
    var plusBtn = document.querySelector('.plus-btn');
    var quantityInput = document.querySelector('.quantity');

    minusBtn.addEventListener('click', function () {
        var value = parseInt(quantityInput.value);
        if (value > 1) {
            value--;
            quantityInput.value = value;
        }
    });

    plusBtn.addEventListener('click', function () {
        var value = parseInt(quantityInput.value);
        value++;
        quantityInput.value = value;
    });
}

// Hàm đóng hộp thoại Bảng kích thước
function handleCloseSizeGuideBox() {
    document.getElementById('closeBox').addEventListener('click', function () {
        var groupSize = document.querySelector('.group-size');
        groupSize.classList.remove('zoom-in');
        groupSize.classList.add('zoom-out');
        setTimeout(function () {
            document.querySelector('.box-select-size').style.display = 'none';
        }, 300);

    });
}

//Hàm xử lý dropdown 
function handleDropdown() {
    var dropdownDescribe = document.querySelector('.dropdown-describe');
    var dropdownDelivery = document.querySelector('.dropdown-delivery');
    var dropdownAccordion = document.querySelector('.dropdown-accordion');
    var dropdownSize = document.querySelector('.dropdown-size');

    var menuListDescribe = document.querySelector('.describe-list');
    var menuListDelivery = document.querySelector('.delivery-list');
    var menuListAccordion = document.querySelector('.accordion-list');
    var menuListSize = document.querySelector('.size-item');

    dropdownDescribe.addEventListener('click', function () {
        toggleMenu(menuListDescribe);
    });

    dropdownDelivery.addEventListener('click', function () {
        toggleMenu(menuListDelivery);
    });

    dropdownAccordion.addEventListener('click', function () {
        toggleMenu(menuListAccordion);
    });

    dropdownSize.addEventListener('click', function () {
        toggleMenu(menuListSize);
    });

    function toggleMenu(menu) {
        if (menu.classList.contains('show1')) {
            menu.classList.remove('show1');
            menu.classList.add('hide1');
        } else {
            menu.classList.remove('hide1');
            menu.classList.add('show1');
        }
    }
}

//Hàm xử lý lấy image size
function handleImageSize() {
    var handleClick = document.getElementById('showSizeGuide');
    var handleDropdownClick = document.getElementById('dropdown-size');

    handleClick.addEventListener('click', function () {
        var tenloai = document.getElementById('tenLoaiValue').value;
        var src = determineSrcByTenLoai(tenloai);
        document.getElementById('sizeGuideImage').src = src;
    });

    handleDropdownClick.addEventListener('click', function () {
        var tenloai = document.getElementById('tenLoaiValue').value;
        var src = determineSrcByTenLoai(tenloai);
        document.getElementById('sizeImage').src = src;
    });
}

function determineSrcByTenLoai(tenloai) {
    if (tenloai === "Áo sơ mi") {
        return "../../images/BangDoAoSoMi.png";
    } else if (tenloai === "Quần jeans") {
        return "../../images/BangDoJeans.jpg";
    } else if (tenloai === "Áo thun") {
        return "../../images/BangDoAoThun.png";
    } else if (tenloai === "Sweater") {
        return "../../images/BangDoSweater.jpg";
    } else if (tenloai === "Hoodie") {
        return "../../images/BangDoHoodie.png";
    } else {
        return "../../images/BangDoShort.png";
    }
}

function handleBackToTop() {
    var backToTopButton = document.getElementById('backToTop');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    backToTopButton.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

function initializeRating() {
    var stars = document.querySelectorAll('.star-icon');
    var radioButtons = document.querySelectorAll('.avaliacou input');
    var titles = document.querySelectorAll('.title-comment-point');

    function updateStarStyling() {
        stars.forEach(function (star, index) {
            var checked = radioButtons[index].checked;
            star.classList.toggle('ativo', checked);
            titles[index].classList.toggle('select', checked);
        });
    }

    document.addEventListener("click", function (e) {
        var classStar = e.target.classList;
        if (classStar.contains('star-icon')) {
            var index = Array.from(stars).indexOf(e.target);
            radioButtons[index].checked = !radioButtons[index].checked;
            updateStarStyling();
        }
    });

    function setDefaultRating() {
        var checkedButton = Array.from(radioButtons).find(radioButton => radioButton.checked);
        if (!checkedButton) {
            radioButtons[4].checked = true;
            updateStarStyling();
        }
    }

    setDefaultRating();
}

document.addEventListener("DOMContentLoaded", initializeRating);

$(document).ajaxComplete(function () {
    initializeRating();
});

function handleCreateComment() {
    var createComment = document.querySelectorAll('.btn-create-comment');
    var showCreate = document.querySelector('.box-create-comment');
    var formCreateComment = document.querySelector('.form-create-comment')

    createComment.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            formCreateComment.classList.add('zoom-in');
            formCreateComment.classList.remove('zoom-out');
            showCreate.classList.toggle('show');
        });
    });
}

function handleCloseCommentBox() {
    document.getElementById('close-box-comment').addEventListener('click', function () {
        var commentBox = document.querySelector('.box-create-comment');
        var formCreateComment = document.querySelector('.form-create-comment')
        formCreateComment.classList.add('zoom-out');
        formCreateComment.classList.remove('zoom-in');
        setTimeout(function () {
            commentBox.classList.remove('show');
        }, 300);
    });
}

function handleSearchForm() {
    const searchInput = document.querySelector('.search');
    const searchIcon = document.querySelector('.ic-search');

    searchIcon.addEventListener('click', function (e) {
        if (!searchInput.classList.contains('expanded')) {
            e.preventDefault(); // Prevent form submission on first click
            searchInput.classList.add('expanded');
            searchInput.focus();
        }
    });

    searchInput.addEventListener('blur', function () {
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
        success: function (response) {
            // Xử lý dữ liệu trả về
            var newUrl = "{{ route('products.search') }}" + '?search_query=' + encodeURIComponent(
                searchQuery);
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
            window.location.reload();
        },
        error: function (xhr) {
            // Xử lý lỗi
            console.log(xhr.responseText);
        }
    });
}

// Gọi các hàm khi DOM đã được tải hoàn toàn
document.addEventListener('DOMContentLoaded', function () {
    // Định dạng giá
    formatPriceElements();
    // Xử lý sự kiện khi chọn kích thước
    handleSizeButtons();
    // Xử lý sự kiện khi click vào liên kết "Hiển thị Bảng kích thước"
    handleSizeGuideLink();
    // Xử lý sự kiện thay đổi số lượng
    handleQuantityButtons();
    // Đóng hộp thoại Bảng kích thước
    handleCloseSizeGuideBox();
    // Xử lý sự kiện khi click vào dropdown
    handleDropdown();
    //Xử lý sự kiện lấy size image
    handleImageSize();

    handleBackToTop();

    handleCreateComment();

    handleSearchForm();

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            submitSearch();
        }
    });
    handleCloseCommentBox();
});


