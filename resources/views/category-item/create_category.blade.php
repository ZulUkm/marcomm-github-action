<?php $page = 'add-category'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Create Category</h4>
                        <h6>Create new category</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <x:card-refresh />
                    <x:card-collapse />
                </ul>
                <x:card-back-button />
            </div>
            <form action="{{ route('product-category.store') }}" class="add-product-form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="add-product">
                    <div class="accordions-items-seperate" id="accordionSpacingExample">

                        
                        <div class="accordion-item border mb-4">
                            <h2 class="accordion-header" id="headingSpacingOne">
                                <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                    data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                        <h5 class="d-flex align-items-center">
                                            <i data-feather="info" class="text-primary me-2"></i>
                                            <span>Category Information</span>
                                        </h5>
                                    </div>
                                </div>
                            </h2>
                            <div id="SpacingOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingSpacingOne">
                                <div class="accordion-body border-top">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Category Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter category name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-2">Status <span class="text-danger">*</span></label>
                                            <div class="d-flex flex-column gap-2 ms-2">
                                                <div>
                                                    <input type="radio" class="btn-check" name="status" id="active"
                                                        value="1" checked>   

                                                    <label class="btn btn-outline-success w-40" for="active">Active</label>

                                                    <input type="radio" class="btn-check" name="status" id="inactive"
                                                        value="0">
                                                    <label class="btn btn-outline-secondary w-40" for="inactive">Inactive</label>

                                                    {{-- <input type="radio" class="btn-check" name="status" id="active"
                                                        value="1" {{ $category->is_active == 1 ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success w-40"
                                                        for="active">Active</label>

                                                    <input type="radio" class="btn-check" name="status" id="inactive"
                                                        value="0" {{ $category->is_active == 0 ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-secondary w-40"
                                                        for="inactive">Inactive</label> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border mb-4">
                            <h2 class="accordion-header" id="headingSpacingThree">
                                <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                    data-bs-target="#SpacingThree" aria-expanded="true" aria-controls="SpacingThree">
                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                        <h5 class="d-flex align-items-center">
                                            <i data-feather="image" class="text-primary me-2"></i>
                                            <span>Category Images</span>
                                        </h5>
                                    </div>
                                </div>
                            </h2>
                            <div id="SpacingThree" class="accordion-collapse collapse show"
                                aria-labelledby="headingSpacingThree">
                                <div class="accordion-body border-top">
                                    <div class="text-editor add-list add">
                                        <div class="col-lg-12">
                                            <div class="add-choosen d-flex align-items-start flex-wrap gap-2"
                                                id="imagePreviewContainer">

                                                {{-- Upload button (same design as Dropzone) --}}
                                                <div class="mb-3 image-upload image-upload-two"
                                                    style="width: 250px; height: 320px;">
                                                    <input type="file" name="image" id="categoryImageInput"
                                                        accept="image/*" hidden>
                                                    <label for="categoryImageInput">
                                                        <div class="image-uploads"
                                                            style="cursor:pointer; text-align:center;">
                                                            <i data-feather="plus-circle" class="plus-down-add me-0"
                                                                style="font-size:24px; margin-bottom:6px;"></i>
                                                            <h4>Add Images</h4>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div id="preview-template" class="d-none">
                                                    <div class="phone-img  dz-preview dz-file-preview">
                                                        <img data-dz-thumbnail id="preview-image" src=""
                                                            alt="preview" style="max-width:250px; border-radius:12px;" />
                                                        <button type="button" id="remove-image"
                                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">x</button>
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
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-end mb-4">
                        <x:card-cancel-button />
                        <button type="submit" class="btn btn-primary">Add New Category</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="footer d-flex justify-content-center align-items-center border-top bg-white p-3">
            <p class="mb-0 text-gray-9 text-center w-100">2025 &copy; MARCOMMs. All Right Reserved</p>
        </div>
    </div>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById("categoryImageInput"); 
            const tplRoot = document.getElementById("preview-template");
            const container = document.getElementById("imagePreviewContainer");

            if (!input || !tplRoot || !container) {
                console.warn(
                    "Image upload elements not found. Check IDs: #categoryImageInput, #preview-template, #imagePreviewContainer"
                    );
                return;
            }

            const tileWrapper = container.querySelector(".image-upload.image-upload-two");
            const tileInner = container.querySelector(".image-upload-two .image-uploads");

            if (window.feather) feather.replace();

            function getTileBoxSize() {
                if (!tileWrapper) return 320; 
                const rect = tileWrapper.getBoundingClientRect();
                const size = Math.round(Math.min(rect.width || 0, rect.height || 0));
                return size > 0 ? size : 220;
            }

            function setTileBoxSize(size) {
                if (tileWrapper) {
                    tileWrapper.style.width = size + "px";
                    tileWrapper.style.height = size + "px";
                }
                if (tileInner) {
                    tileInner.style.height = "100%";
                    tileInner.style.display = "flex";
                    tileInner.style.flexDirection = "column";
                    tileInner.style.alignItems = "center";
                    tileInner.style.justifyContent = "center";
                }
            }

            setTileBoxSize(getTileBoxSize());

            const tileClickable = container.querySelector(".image-upload-two .image-uploads");
            if (tileClickable) {
                tileClickable.addEventListener("click", function(e) {
                    e.preventDefault();
                    input.click();
                });
            }

            function makeSquareThumb(file, size, done) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement("canvas");
                        canvas.width = size;
                        canvas.height = size;
                        const ctx = canvas.getContext("2d");

                        const scale = Math.max(size / img.width, size / img.height);
                        const srcW = size / scale;
                        const srcH = size / scale;
                        const sx = (img.width - srcW) / 2;
                        const sy = (img.height - srcH) / 2;

                        ctx.drawImage(img, sx, sy, srcW, srcH, 0, 0, size, size);
                        done(canvas.toDataURL("image/png"), size);
                    };
                    img.src = ev.target.result;
                };
                reader.readAsDataURL(file);
            }

            const baseCard = tplRoot.querySelector(".phone-img");

            function addPreview(file) {
                const size = getTileBoxSize();

                makeSquareThumb(file, size, function(dataUrl, sizeUsed) {
                    container.querySelectorAll(".phone-img").forEach(el => el.remove());

                    const preview = baseCard.cloneNode(true);
                    preview.classList.remove("dz-preview", "dz-file-preview");

                    preview.style.width = sizeUsed + "px";
                    preview.style.height = sizeUsed + "px";
                    preview.style.overflow = "hidden";
                    preview.style.position = "relative";
                    preview.style.display = "inline-block";

                    const img = preview.querySelector("#preview-image");
                    if (img) {
                        img.removeAttribute("style"); 
                        img.setAttribute("width", sizeUsed);
                        img.setAttribute("height", sizeUsed);
                        img.src = dataUrl; 
                        
                        img.style.width = sizeUsed + "px";
                        img.style.height = sizeUsed + "px";
                        img.style.objectFit = "cover";
                        img.removeAttribute("id"); 
                    }

                    
                    const removeBtn = preview.querySelector("#remove-image");
                    if (removeBtn) {
                        removeBtn.removeAttribute("id");
                        removeBtn.addEventListener("click", function() {
                            input.value = ""; 
                            preview.remove();
                        });
                    }

                    container.appendChild(preview);

                    
                    setTileBoxSize(sizeUsed);

                    if (window.feather) feather.replace();
                    
                });
            }

           
            input.addEventListener("change", function() {
                if (!input.files || input.files.length === 0) return;
                addPreview(input.files[0]); 
            });

            
            window.addEventListener("resize", function() {
                const lastPreview = container.querySelector(".phone-img:last-of-type");
                if (lastPreview) {
                    const rect = lastPreview.getBoundingClientRect();
                    const size = Math.round(Math.min(rect.width || 0, rect.height || 0));
                    if (size > 0) setTileBoxSize(size);
                } else {
                    setTileBoxSize(getTileBoxSize());
                }
            });
        });
    </script>
@endsection
