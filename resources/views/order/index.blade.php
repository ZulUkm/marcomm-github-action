<?php $page = 'pos-orders'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <x:page-title title="POS Orders" description="Manage Your pos orders" />
                <x-button-href href="{{ route('orders.create') }}" class="btn btn-primary" text="Add Order" />
            </div>

            <!-- /product list -->
            <x-card-table>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Order Number</th>
                                <th>Name</th>
                                <th>Event Name</th>
                                <th>Status</th>
                                <th>Collect Date</th>
                                <th>Event Date </th>
                                <th>Return Date</th>
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
                                    <td>null</td>
                                    <td class="text-center">
                                        <x-card-view-button :url="route('orders.show', $order->id)" />
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
