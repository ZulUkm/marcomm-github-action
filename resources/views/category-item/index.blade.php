<?php $page = 'category-item'; ?>
@extends('layout.mainlayout')
@section('content')
    {{-- Current locale: {{ app()->getLocale() }} --}}

    <div class="page-wrapper">
        <div class="content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Category</h4>
                        <h6>Manage your categories</h6>
                        {{-- <h4 class="fw-bold">{{ __('messages.category') }}</h4>
                        <h6>{{ __('messages.manage_category') }}</h6>
                        <div>Session locale: {{ session('locale') }}</div>
                        <div>Current locale: {{ app()->getLocale() }}</div> --}}

                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <x:card-jana-pdf />
                    </li>
                    <li>
                        <x:card-jana-excel />
                    </li>
                    <li>
                        <x:card-refresh />
                    </li>
                    <li>
                        <x:card-collapse />
                    </li>
                </ul>
                <div class="page-btn">
                    <x:card-tambah-kategori />
                </div>
            </div>
            <!-- /product list -->
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
                        <div class="dropdown">
                            <a href="javascript:void(0);"
                                class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                Category
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li>
                                    <form method="GET" action="{{ request()->url() }}">
                                        <input type="hidden" name="category" id="category-input" value="">
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1 category-filter"
                                            data-category="__ALL__">
                                            All
                                        </a>
                                        @foreach ($allCategories as $cat)
                                            <a href="javascript:void(0);" class="dropdown-item rounded-1 category-filter"
                                                data-category="{{ $cat }}">
                                                {{ $cat }}
                                            </a>
                                        @endforeach
                                    </form>
                                </li>
                            </ul>
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
                                    <th rowspan="1" colspan="1">Category</th>
                                    <th class="text-center" rowspan="1" colspan="1">Category Image</th>
                                    <th class="text-center" rowspan="1" colspan="1">Created On</th>
                                    <th class="text-center" rowspan="1" colspan="1">Created By</th>
                                    <th rowspan="1" colspan="1" style="width: 262px; text-align: center;">Status</th>
                                    <th rowspan="1" colspan="1" style="width: 128px; text-align: center;">Action</th>
                                    {{-- <th class="no-sort"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center" rowspan="1" colspan="1">
                                            <label class="checkboxs">
                                                <input type="checkbox" value="{{ $category->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td rowspan="1" colspan="1"><span
                                                class="text-gray-9">{{ $category->name }}</span></td>
                                        <td class="text-center" rowspan="1" colspan="1">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="javascript:void(0);" class="avatar avatar-md">
                                                    @php
                                                        $att = $category->attachments->first();
                                                        $src = null;
                                                        if ($att?->url) {
                                                            $src = Storage::disk('public_raw')->url(ltrim($att->path, '/'));
                                                        } elseif ($att?->path) {
                                                            $src = Storage::disk('public_raw')->url(ltrim($att->path, '/'));
                                                        }
                                                        if (!$src && filled($category->image)) {
                                                            $legacy = $category->image;
                                                            if (\Illuminate\Support\Str::startsWith($legacy, ['storage/', '/storage/'])) {
                                                                $src = asset(ltrim($legacy, '/'));
                                                            } elseif (\Illuminate\Support\Str::startsWith($legacy, ['http://', 'https://'])) {
                                                                $src = $legacy;
                                                            } else {
                                                                $src = asset('storage/' . ltrim($legacy, '/'));
                                                            }
                                                        }
                                                        $src = $src ?? asset('build/img/products/placeholder.png');
                                                    @endphp
                                                    <img src="{{ $src }}" alt="{{ $category->name }}">
                                                </a>
                                            </div>
                                        </td>


                                        <td class="text-center" rowspan="1" colspan="1">
                                            {{ $category->created_at?->format('d M Y') ?? '—' }}</td>
                                        <td class="text-center" rowspan="1" colspan="1">
                                            {{ $category->created_by ?? '—' }}</td>
                                        <td style="width: 262px; text-align: center;">
                                            <span
                                                class="d-none status-text">{{ $category->is_active ? 'Active' : 'Inactive' }}</span>

                                            <x:card-status :status="$category->is_active ? 'Active' : 'Inactive'" />
                                        </td>


                                        {{-- <td rowspan="1" colspan="1" style="width: 262px; text-align: center;">
                                            <x:card-status :status="$category->is_active ? 'Active' : 'Inactive'" />

                                        </td> --}}
                                        <td rowspan="1" colspan="1" style="width: 262px; text-align: center;">
                                            <div class="edit-delete-action">
                                                <x:card-edit-button :url="route('product-category.edit', $category->id)"
                                                    :itemName="$category->name" />

                                                <x:card-delete-button
                                                    :url="route('product-category.destroy', $category->id)"
                                                    :itemName="$category->name" />
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
        <div class="footer d-flex justify-content-center align-items-center border-top bg-white p-3">
            <p class="mb-0 text-gray-9 text-center w-100">2025 &copy; MARCOMMs. All Right Reserved</p>
            {{-- <p>Designed &amp; Developed by <a href="javascript:void(0);" class="text-primary">UKMShape</a></p> --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.status-filter').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const picked = this.getAttribute('data-status');
                    const input = document.getElementById('status-input');
                    input.value = picked === 'all' ? '' : picked;
                    document.getElementById('status-form').submit();
                });
            });

            document.querySelectorAll('.category-filter').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const picked = this.getAttribute('data-category');
                    const input = document.getElementById('category-input');
                    input.value = picked === '__ALL__' ? '' : picked;
                    input.form.submit();
                });
            });
        });
    </script>
@endpush
