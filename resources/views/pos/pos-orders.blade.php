<?php $page = 'pos-orders'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <x:page-title title="POS Orders" description="Manage Your pos orders" />
                <x-button-href href="{{ route('pos.order') }}" class="btn btn-primary" text="Add Order" />
            </div>

            <!-- /product list -->
            <x-card-table>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>ukmper</th>
                                <th>name</th>
                                <th>event name</th>
                                <th>status</th>
                                <td>date collect</td>
                                <th>date event</th>
                                <th>date return</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="sales-list">
                            <tr>
                                <td>
                                    KQ01563
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                            <img src="{{ URL::asset('build/img/users/user-01.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">John Doe</a>
                                    </div>
                                </td>
                                <td>Event Name</td>
                                <td><span class="badge badge-success">Completed</span></td>
                                <td>24 Dec 2024</td>
                                <td>24 Dec 2024</td>
                                <td>24 Dec 2024</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#sales-details-new"><i data-feather="eye"
                                                    class="info-img"></i>Sale Detail</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('edit-sales') }}" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new"><i data-feather="edit"
                                                    class="info-img"></i>Edit Sale</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#showpayment"><i data-feather="dollar-sign"
                                                    class="info-img"></i>Show Payments</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#createpayment"><i data-feather="plus-circle"
                                                    class="info-img"></i>Create Payment</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item"><i data-feather="download"
                                                    class="info-img"></i>Download pdf</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item mb-0" data-bs-toggle="modal"
                                                data-bs-target="#delete"><i data-feather="trash-2"
                                                    class="info-img"></i>Delete Sale</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    KQ01564
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                            <img src="{{ URL::asset('build/img/users/user-01.jpg') }}" alt="product">
                                        </a>
                                        <a href="javascript:void(0);">John Doe</a>
                                    </div>
                                </td>
                                <td>Event Name</td>
                                <td><span class="badge badge-success">Completed</span></td>
                                <td>24 Dec 2024</td>
                                <td>24 Dec 2024</td>
                                <td>24 Dec 2024</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#sales-details-new"><i data-feather="eye"
                                                    class="info-img"></i>Sale Detail</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('edit-sales') }}" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#edit-sales-new"><i data-feather="edit"
                                                    class="info-img"></i>Edit Sale</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#showpayment"><i data-feather="dollar-sign"
                                                    class="info-img"></i>Show Payments</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#createpayment"><i data-feather="plus-circle"
                                                    class="info-img"></i>Create Payment</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    data-feather="download" class="info-img"></i>Download pdf</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item mb-0"
                                                data-bs-toggle="modal" data-bs-target="#delete"><i data-feather="trash-2"
                                                    class="info-img"></i>Delete Sale</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-card-table>
            <!-- /product list -->
        </div>
        <x-footer />

    </div>
@endsection
