<?php $page = 'edit-category'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Edit Category</h4>
                        <h6>Edit your category</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <x:card-refresh />
                    <x:card-collapse />
                </ul>
                <x:card-back-button />
            </div>
            <form action="{{ route('product-category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="add-product-form">
                @csrf
                @method('PUT') 
                
                <div class="add-product">
                    <div class="accordions-items-seperate" id="accordionSpacingExample">
                        <div class="accordion-item border mb-4">
                            <h2 class="accordion-header" id="headingSpacingOne">
                                <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse" data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                    <h5 class="d-flex align-items-center"><i data-feather="info" class="text-primary me-2"></i><span>Category Information</span></h5>
                                    </div>
                                </div>
                            </h2>
                            <div id="SpacingOne" class="accordion-collapse collapse show">
                                <div class="accordion-body border-top">
                                    <div class="row">
                                        
                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                                            </div>
                                        </div>

                                    
                                        <div class="col-md-6">
                                            <label class="form-label mb-2">Status <span class="text-danger">*</span></label>
                                            <div class="d-flex flex-column gap-2 ms-2">
                                                <div>
                                                    <input type="radio" class="btn-check" name="status" id="active" value="1" 
                                                        {{ $category->is_active == 1 ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success w-40" for="active">Active</label>

                                                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                                                        {{ $category->is_active == 0 ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-secondary w-40" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="accordion-item border mb-4">
                        <h2 class="accordion-header" id="headingSpacingThree">
                            <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse" data-bs-target="#SpacingThree" aria-expanded="true" aria-controls="SpacingThree">
                            <div class="d-flex align-items-center justify-content-between flex-fill">
                                <h5 class="d-flex align-items-center">
                                <i data-feather="image" class="text-primary me-2"></i>
                                <span>Category Images</span>
                                </h5>
                            </div>
                            </div>
                        </h2>
                            <div id="SpacingThree" class="accordion-collapse collapse show">
                                <div class="accordion-body border-top">

                                <div class="mb-3">
                                    <label class="form-label">Upload Image</label>
                                    <input type="file" name="image" class="form-control">

                                    @php
                                    
                                    $att = $category->attachments->first();   
                                    $src = $att?->path ? asset('storage/'.ltrim($att->path, '/')) : null;

                                    
                                    if (!$src && !empty($category->image)) {
                                        $legacy = $category->image;
                                        $src = \Illuminate\Support\Str::startsWith($legacy, 'storage/')
                                            ? asset($legacy)
                                            : asset('storage/'.ltrim($legacy, '/'));
                                    }

                                    
                                    $src = $src ?? asset('build/img/products/placeholder.png');
                                    @endphp

                                    <div class="mt-3">
                                    <img src="{{ $src }}" alt="Current Image" width="160" class="rounded border">
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-end mb-4">
                        <x:card-cancel-button />
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="footer d-flex justify-content-center align-items-center border-top bg-white p-3">
			<p class="mb-0 text-gray-9 text-center w-100">2025 &copy; MARCOMMs. All Right Reserved</p>
			{{-- <p>Designed &amp; Developed by <a href="javascript:void(0);" class="text-primary">UKMShape</a></p> --}}
		</div>
    </div>
@endsection



