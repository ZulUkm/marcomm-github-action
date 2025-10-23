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
                                        name="'Headset'" />

                                    <x:card-category id="laptops" image="build/img/products/pos-product-07.png"
                                        name="Laptop" />
                                </ul>
                            </div>
                            <div class="tab-content-wrap">
                                <div class="pos-products">
                                    <div class="tabs_container">
                                        <div class="tab_content active" data-tab="all">
                                            <div class="row g-3">
                                                <x-card-container :image="'build/img/products/pos-product-01.png'" category="Mobiles" name="IPhone 16 64GB"
                                                    :price="100" :qty="4" />
                                                <x-card-container :image="'build/img/products/pos-product-01.png'" category="Mobiles" name="IPhone 14 64GB"
                                                    :price="200" :qty="4" />
                                                <x-card-container :image="'build/img/products/pos-product-01.png'" category="Casing" name="IPhone 14 64GB"
                                                    :price="100" :qty="4" />
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
        </div>
    </div>
@endsection
