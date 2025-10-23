<?php $page = 'users'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Users</h4>
                        <h6>Manage your users</h6>
                    </div>
                </div>
                <div class="page-btn">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user"><i
                            class="ti ti-circle-plus me-1"></i>Add User</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
                            <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        </div>
                    </div>
                    <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">

                        <div class="dropdown me-3"> 
                            <a href="javascript:void(0);"
                                class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                Status
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item status-filter" data-status="" href="#">All</a></li>
                                <li><a class="dropdown-item status-filter" data-status="1" href="#">Active</a></li>
                                <li><a class="dropdown-item status-filter" data-status="0" href="#">Inactive</a></li>
                            </ul>
                            <form method="GET" action="{{ request()->url() }}" id="status-form" style="display:none;">
                                <input type="hidden" name="status-cat" id="status-input" value="">
                            </form>

                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Ukmper</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="user-checkbox"
                                                    data-user-id="{{ $user->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>{{ $user->ukmper }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                    <img src="{{ $user->staff_picture }}" alt="User Photo">
                                                </a>
                                                <a href="javascript:void(0);">{{ $user->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $user->telephone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                                            @endforeach
                                        </td>
                                        <td><x-is-active :value="$user->is_active" />
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                {{-- <a class="me-2 p-2 mb-0" href="{{ route('users.show', $user->id) }}">
                                                    <i data-feather="eye" class="action-eye"></i>
                                                </a> --}}

                                                <a class="me-2 p-2 mb-0" href="{{ route('users.edit', $user->id) }}">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /product list -->
        </div>
        <x-footer />
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.status-filter').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const picked = this.getAttribute('data-status');
                    const input = document.getElementById('status-input');
                    input.value = picked === 'all' ? '' : picked;
                    document.getElementById('status-form').submit();
                });
            });

        });
    </script>
@endpush