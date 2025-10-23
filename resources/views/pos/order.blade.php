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
                                    <x:card-category id="headphones" image="build/img/products/pos-product-08.png"
                                        name="Headset" />
                                </ul>
                            </div>
                            <div class="tab-content-wrap">
                                <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                    <div class="mb-3">
                                        <h5 class="mb-1">Welcome, Zul Faris Bin Mazlan</h5>
                                        <p>{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
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
                                                <x:card-container :image="'build/img/products/pos-product-01.png'"
                                                    category="Mobiles" name="IPhone 16 64GB" :price="100"
                                                    :qty="4" />

                                                <x:card-container :image="'build/img/products/pos-product-01.png'"
                                                    category="Mobiles" name="IPhone 14 64GB" :price="200"
                                                    :qty="4" />


                                            </div>
                                        </div>
                                        <x:pos-tab-content id="headphonessss" image="build/img/products/pos-product-05.png"
                                            name="Headphones" price="$5478" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Products -->

                <x:card-order-list />


            </div>
            <x:footer-pos />
        </div>
    </div>
@endsection
