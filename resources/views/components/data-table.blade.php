@props([
    'items' => [],
    'columns' => [],
    'checkboxes' => true,
    'tableClass' => 'table datatable',
    'viewRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
])

<div class="table-responsive">
    <table class="{{ $tableClass }}">
        <thead class="thead-light">
            <tr>
                @if ($checkboxes)
                    <th class="no-sort text-center align-middle">
                        <label class="checkboxs mb-0">
                            <input type="checkbox" id="select-all">
                            <span class="checkmarks"></span>
                        </label>
                    </th>
                @endif

                @foreach ($columns as $column)
                    <th class="align-middle">{{ $column['label'] }}</th>
                @endforeach

                @if ($viewRoute || $editRoute || $deleteRoute)
                    <th class="no-sort text-center align-middle">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    @if ($checkboxes)
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" value="{{ $item->id }}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                    @endif

                    @foreach ($columns as $column)
                        <td>
                            @if (isset($column['format']))
                                {!! $column['format']($item) !!}
                            @elseif(isset($column['field']))
                                @php
                                    $field = $column['field'];
                                    $value = $item;

                                    // Handle dot notation for relationships
                                    foreach (explode('.', $field) as $segment) {
                                        $value = is_object($value) && isset($value->$segment) ? $value->$segment : null;
                                    }

                                    // Check if there's a default value
$default = $column['default'] ?? '';
                                    $value = $value ?? $default;
                                @endphp

                                @if (isset($column['class']))
                                    <span class="{{ $column['class'] }}">{{ $value }}</span>
                                @else
                                    {{ $value }}
                                @endif
                            @endif
                        </td>
                    @endforeach

                    @if ($viewRoute || $editRoute || $deleteRoute)
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                @if ($viewRoute)
                                    <x-card-view-button :url="route($viewRoute, $item->id)" />
                                @endif

                                @if ($editRoute)
                                    <x-card-edit-button :url="route($editRoute, $item->id)" />
                                @endif

                                @if ($deleteRoute)
                                    <x-card-delete-button :url="route($deleteRoute, $item->id)" />
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + ($checkboxes ? 1 : 0) + ($viewRoute || $editRoute || $deleteRoute ? 1 : 0) }}"
                        class="text-center">
                        No data available
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>




{{-- <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort text-center align-middle">
                                        <label class="checkboxs mb-0">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th class="align-middle">ID</th>
                                    <th class="align-middle">Product Name</th>
                                    <th class="align-middle">Description</th>
                                    <th class="align-middle">Category</th>
                                    <th class="align-middle">Quantity</th>
                                    <th class="align-middle">Return Status</th>
                                    <th class="align-middle">Status</th>
                                    <th class="no-sort text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td><span class="text-gray-9">{{ $product->id }}</span></td>
                                        <td><span class="text-gray-9">{{ $product->name }}</span></td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                        <td>{{ $product->stocks->sum('quantity') }}</td>
                                        <td>
                                            @if ($product->is_returnable)
                                                <x-card-return-status status="Returnable" />
                                            @else
                                                <x-card-return-status status="Non-returnable" />
                                            @endif
                                        </td>
                                        <td><x-card-status status="{{ $product->status }}" /></td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <x:card-view-button :url="route('products.show', $product->id)" />
                                                <x:card-edit-button :url="route('products.edit', $product->id)" />
                                                <x:card-delete-button :url="route('products.destroy', $product->id)" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
