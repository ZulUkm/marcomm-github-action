<?php $page = 'pos-orders'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <div class="page-title">
                            <h4>Admin Dashboard</h4>
                            <h6>Welcome back, {{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <x-total-order :count="$totalOrders" />
                <x-total-pending-order :count="$pendingOrders" />
                <x-total-product :count="$totalProducts" />
                <x-total-category :count="$totalCategories" />
            </div>

            <div class="row">
                <x-low-stock />
                <x-top-product />
            </div>
        </div>
        <x-footer />
    </div>
@endsection
