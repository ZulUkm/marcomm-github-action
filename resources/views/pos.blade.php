<?php $page = 'pos'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper pos-pg-wrapper ms-0">
        <div class="content pos-design p-0">

            <div class="row pos-wrapper">

                <!-- Products -->
                <div class="col-md-12 col-lg-7 col-xl-8 d-flex">
                    <div class="pos-categories tabs_wrapper p-0 flex-fill">
                        <div class="content-wrap">
                            <div class="tab-wrap">
                                <ul class="tabs owl-carousel pos-category5">
                                    <li id="all" class="active">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-01.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">All</a></h6>
                                    </li>
                                    <li id="headphones">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-08.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">Headset</a></h6>
                                    </li>
                                    <li id="shoes">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-04.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">Shoes</a></h6>
                                    </li>
                                    <li id="mobiles">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-15.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">Mobiles</a></h6>
                                    </li>
                                    <li id="watches">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-03.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">Watches</a></h6>
                                    </li>
                                    <li id="laptops">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-12.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">Laptops</a></h6>
                                    </li>
                                    <li id="appliances">
                                        <a href="javascript:void(0);">
                                            <img src="{{ URL::asset('build/img/products/pos-product-05.png') }}"
                                                alt="Categories">
                                        </a>
                                        <h6><a href="javascript:void(0);">Appliance</a></h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content-wrap">
                                <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                    <div class="mb-3">
                                        <h5 class="mb-1">Welcome, Wesley Adrian</h5>
                                        <p>December 24, 2024</p>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap mb-2">
                                        <div class="input-icon-start search-pos position-relative mb-2 me-3">
                                            <span class="input-icon-addon">
                                                <i class="ti ti-search"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Search Product">
                                        </div>
                                        <a href="#" class="btn btn-sm btn-dark mb-2 me-2"><i
                                                class="ti ti-tag me-1"></i>View All Brands</a>
                                        <a href="#" class="btn btn-sm btn-primary mb-2"><i
                                                class="ti ti-star me-1"></i>Featured</a>
                                    </div>
                                </div>
                                <div class="pos-products">
                                    <div class="tabs_container">
                                        <div class="tab_content active" data-tab="all">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-01.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                                64GB </a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$15800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-07.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IdeaPad
                                                                Slim 5 Gen 7</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1454</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-08.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                        </h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$6587</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-09.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Timex Black
                                                                Silver</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1457</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-10.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Tablet 1.02
                                                                inch</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$4744</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-11.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Fossil Pair
                                                                Of 3 in 1 </a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$789</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-13.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Green Nike
                                                                Fe</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$7847</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab_content" data-tab="headphones">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-05.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Airpod
                                                                2</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$5478</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-08.png') }}"
                                                                alt="Products">
                                                            <span><i data-feather="check" class="feather-16"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                        </h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$6587</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab_content" data-tab="shoes">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-04.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Red Nike
                                                                Angelo</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$7800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-06.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Blue White
                                                                OGR</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$987</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-13.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Green Nike
                                                                Fe</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$7847</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab_content" data-tab="mobiles">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-01.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                                64GB</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$15800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-10.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Iphone
                                                                11</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$3654</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab_content" data-tab="watches">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-03.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Rolex
                                                                Tribute V3</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$6800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-09.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Timex Black
                                                                Silver</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1457</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-11.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Fossil Pair
                                                                Of 3 in 1 </a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$789</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab_content" data-tab="laptops">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-02.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">MacBook
                                                                Pro</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1000</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-07.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IdeaPad
                                                                Slim 5 Gen 7</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1454</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-10.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Tablet 1.02
                                                                inch</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$4744</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-12.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Yoga Book
                                                                9i</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$4784</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-14.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IdeaPad
                                                                Slim 3i</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1245</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab_content" data-tab="appliances">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-01.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                                64GB</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$15800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-02.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">MacBook
                                                                Pro</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1000</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-03.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Rolex
                                                                Tribute V3</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$6800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-04.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Red Nike
                                                                Angelo</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$7800</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-05.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Airpod
                                                                2</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$5478</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-06.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Blue White
                                                                OGR</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$987</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-07.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">IdeaPad
                                                                Slim 5 Gen 7</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1454</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-08.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                        </h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$6587</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-09.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Timex
                                                                Black Silver</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$1457</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-10.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Computer</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Tablet
                                                                1.02 inch</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$4744</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-11.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Watches</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Fossil
                                                                Pair Of 3 in 1 </a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$789</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
                                                    <div class="product-info card mb-0">
                                                        <a href="javascript:void(0);" class="pro-img">
                                                            <img src="{{ URL::asset('build/img/products/pos-product-06.png') }}"
                                                                alt="Products">
                                                            <span><i class="ti ti-circle-check-filled"></i></span>
                                                        </a>
                                                        <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a>
                                                        </h6>
                                                        <h6 class="product-name"><a href="javascript:void(0);">Green
                                                                Nike Fe</a></h6>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between price">
                                                            <p class="text-gray-9 mb-0">$7847</p>
                                                            <div class="qty-item m-0">
                                                                <a href="javascript:void(0);"
                                                                    class="dec d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="minus"><i class="ti ti-minus"></i></a>
                                                                <input type="text" class="form-control text-center"
                                                                    name="qty" value="4">
                                                                <a href="javascript:void(0);"
                                                                    class="inc d-flex justify-content-center align-items-center"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="plus"><i class="ti ti-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Products -->

                <x:card-order-list />


            </div>

            <div class="pos-footer bg-white p-3 border-top">
                <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                    <a href="javascript:void(0);"
                        class="btn btn-orange d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#hold-order"><i
                            class="ti ti-player-pause me-2"></i>Hold</a>
                    <a href="javascript:void(0);"
                        class="btn btn-info d-inline-flex align-items-center justify-content-center"><i
                            class="ti ti-trash me-2"></i>Void</a>
                    <a href="javascript:void(0);" class="btn btn-cyan d-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#payment-completed"><i
                            class="ti ti-cash-banknote me-2"></i>Payment</a>
                    <a href="javascript:void(0);"
                        class="btn btn-secondary d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#orders"><i class="ti ti-shopping-cart me-2"></i>View
                        Orders</a>
                    <a href="javascript:void(0);"
                        class="btn btn-indigo d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#reset"><i class="ti ti-reload me-2"></i>Reset</a>
                    <a href="javascript:void(0);"
                        class="btn btn-danger d-inline-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#recents"><i
                            class="ti ti-refresh-dot me-2"></i>Transaction</a>
                </div>
            </div>
        </div>
    </div>
@endsection
