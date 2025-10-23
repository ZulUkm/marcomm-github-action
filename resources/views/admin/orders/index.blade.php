<?php $page = 'pos-orders'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">

            <!-- /product list -->
            <x-card-table>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>order_number</th>
                                <th>name</th>
                                <th>event name</th>
                                <th>status</th>
                                <td>date collect</td>
                                <th>date event</th>
                                <th>date return</th>
                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody class="sales-list">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->order_number }}
                                    </td>
                                    <td>
                                        {{ $order->customer->name }}
                                    </td>
                                    <td>{{ $order->event_name }}</td>
                                    <td><x-status-badge :status="$order->status" /></td>
                                    <td>{{ $order->collect_date }}</td>
                                    <td>{{ $order->event_date }}</td>
                                    <td>
                                        {{ $order->orderReturn ? $order->orderReturn->return_date : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <x-card-view-button :url="route('admin.orders.show', $order->id)" />
                                        {{-- <x-order-actions :order="$order" /> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card-table>
            <!-- /product list -->
        </div>
        <x-footer />
    </div>
@endsection
