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
                                    @foreach ($categories as $item)
                                        {{-- {{ $item }} --}}
                                        <x:card-category id="{{ $item->id }}"
                                            image="{{ $item->attachments->first()->path ?? 'No Image' }}"
                                            name="{{ $item->name }}" product="{{ $item->products }}" />
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-content-wrap">
                                <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                    <div class="mb-3">
                                        <h5 class="mb-1">Welcomes, {{ Auth::user()->name }}</h5>
                                        <p>{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="pos-products">
                                    <x-product-tabs-content :categories="$categories" :products="$products" />
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // State management
        const state = {
            orderItems: [],
            elements: {
                cartEmpty: document.querySelector('.cart-empty'),
                productList: document.querySelector('.product-lists'),
                itemCount: document.querySelector('.badge .text-teal'),
                clearButton: document.querySelector('.clear-icon'),
                addButtons: document.querySelectorAll('.add-to-order'),
                orderForm: document.getElementById('order-form'),
                checkoutBtn: document.getElementById('place-order-btn')
            }
        };

        // Add this function to validate before submission
        function setupOrderButton() {
            const {
                checkoutBtn
            } = state.elements;
            if (!checkoutBtn) return;

            checkoutBtn.addEventListener('click', function() {
                if (state.orderItems.length === 0) {
                    showNotification('Please add items to your order first');
                    return;
                }

                // Update form data before submission
                updateFormData();
                console.log('Form data updated, submitting form...');

                // Show loading state
                this.innerHTML = '<i class="ti ti-loader"></i> Processing...';
                this.disabled = true;

                // Submit the form
                const orderForm = document.getElementById('order-form');
                if (orderForm) {
                    orderForm.submit();
                } else {
                    console.error('Order form not found');
                }
            });
        }

        // Initialize the application
        function init() {
            // Verify that all required elements exist
            if (!validateElements()) return;

            // Attach event listeners
            attachEventListeners();

            // Setup order button
            setupOrderButton();

            // Set initial display state
            updateOrderDisplay();

            console.log('POS order system initialized');
        }

        // Add or update this function in your JavaScript
        function updateFormData() {
            const container = document.getElementById('order-items-data');
            if (!container) {
                console.error('Error: order-items-data container not found');
                return;
            }

            // Clear previous fields
            container.innerHTML = '';

            // Add hidden fields for each item
            state.orderItems.forEach((item, index) => {
                // Create product_id field
                const idField = document.createElement('input');
                idField.type = 'hidden';
                idField.name = `items[${index}][product_id]`;
                idField.value = item.id;

                // Create quantity field
                const qtyField = document.createElement('input');
                qtyField.type = 'hidden';
                qtyField.name = `items[${index}][quantity]`;
                qtyField.value = item.quantity;

                // Create price field
                const priceField = document.createElement('input');
                priceField.type = 'hidden';
                priceField.name = `items[${index}][price]`;
                priceField.value = item.price;

                // Add fields to container
                container.appendChild(idField);
                container.appendChild(qtyField);
                container.appendChild(priceField);
            });

            console.log(`Added ${state.orderItems.length} items to form data`);
        }




        // Validate that all required DOM elements exist
        function validateElements() {
            const {
                cartEmpty,
                productList,
                itemCount
            } = state.elements;

            if (!cartEmpty) {
                console.error('Error: Cart empty element not found');
                return false;
            }

            if (!productList) {
                console.error('Error: Product list element not found');
                return false;
            }

            return true;
        }

        // Attach all event listeners
        function attachEventListeners() {
            // Add to order buttons
            state.elements.addButtons.forEach(button => {
                button.addEventListener('click', handleAddToOrder);
            });

            // Clear all button
            if (state.elements.clearButton) {
                state.elements.clearButton.addEventListener('click', handleClearOrder);
            }
        }

        // Event handler for add to order button
        function handleAddToOrder() {
            // Extract product data from data attributes
            const productData = {
                id: this.getAttribute('data-id'),
                name: this.getAttribute('data-name'),
                price: parseFloat(this.getAttribute('data-price')),
                image: this.getAttribute('data-image'),
                quantity: 1
            };

            console.log(`Adding to order: ${productData.name}`);

            addToOrder(productData);
            showNotification(`Added ${productData.name} to order`);
        }

        // Event handler for clear order button
        function handleClearOrder() {
            state.orderItems = [];
            updateOrderDisplay();
        }

        // Add a product to the order
        function addToOrder({
            id,
            name,
            price,
            image,
            quantity
        }) {
            const existingItem = state.orderItems.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                state.orderItems.push({
                    id,
                    name,
                    price,
                    image,
                    quantity
                });
            }

            updateOrderDisplay();
        }

        // Remove a product from the order
        function removeFromOrder(id) {
            state.orderItems = state.orderItems.filter(item => item.id !== id);
            updateOrderDisplay();
        }

        // Update the order display
        function updateOrderDisplay() {
            const {
                cartEmpty,
                productList,
                itemCount,
                checkoutBtn // Add this to use the checkout button
            } = state.elements;
            const hasItems = state.orderItems.length > 0;

            // Update item count
            if (itemCount) {
                itemCount.textContent = state.orderItems.length;
            }

            // Toggle visibility based on whether we have items
            cartEmpty.style.display = hasItems ? 'none' : 'block';
            productList.style.display = hasItems ? 'block' : 'none';

            // Update checkout button state - THIS IS THE IMPORTANT PART YOU'RE MISSING
            if (checkoutBtn) {
                checkoutBtn.disabled = !hasItems;
                if (hasItems) {
                    checkoutBtn.classList.remove('checkout-disabled');
                } else {
                    checkoutBtn.classList.add('checkout-disabled');
                }
            }

            if (!hasItems) return;

            // Update the product list table
            updateProductTable();
        }

        // Update the product table with current items
        function updateProductTable() {
            const tbody = state.elements.productList.querySelector('tbody');
            if (!tbody) {
                console.error('Table body element not found');
                return;
            }

            // Clear existing rows
            tbody.innerHTML = '';

            // Add a row for each item
            state.orderItems.forEach(item => {
                const row = createItemRow(item);
                tbody.appendChild(row);
            });

            // Add event listeners to the new rows
            addTableEventListeners(tbody);
        }

        // Create a table row for an item
        function createItemRow(item) {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>
                <div class="d-flex align-items-center">
                    <a class="delete-icon remove-item" href="javascript:void(0);" data-id="${item.id}">
                        <i class="ti ti-trash"></i>
                    </a>
                    <h6 class="ms-2">${item.name}</h6>
                </div>
            </td>
            <td>
                <div class="qty-item">
                    <a href="javascript:void(0);" class="dec d-flex justify-content-center align-items-center" data-id="${item.id}">
                        <i class="ti ti-minus"></i>
                    </a>
                    <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                    <a href="javascript:void(0);" class="inc d-flex justify-content-center align-items-center" data-id="${item.id}">
                        <i class="ti ti-plus"></i>
                    </a>
                </div>
            </td>
        `;

            return row;
        }

        // Add event listeners to the table rows
        function addTableEventListeners(tbody) {
            // Remove item buttons
            tbody.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    removeFromOrder(id);
                });
            });

            // Increase quantity buttons
            tbody.querySelectorAll('.inc').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const item = state.orderItems.find(item => item.id === id);
                    if (item) {
                        item.quantity++;
                        updateOrderDisplay();
                    }
                });
            });

            // Decrease quantity buttons
            tbody.querySelectorAll('.dec').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const item = state.orderItems.find(item => item.id === id);
                    if (item && item.quantity > 1) {
                        item.quantity--;
                        updateOrderDisplay();
                    }
                });
            });
        }

        // Show a notification message
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'toast-notification';
            notification.textContent = message;
            document.body.appendChild(notification);

            // Remove after delay with fade effect
            setTimeout(() => {
                notification.classList.add('fade-out');
                setTimeout(() => notification.remove(), 500);
            }, 2000);
        }

        // Start the application
        init();
    });
</script>
