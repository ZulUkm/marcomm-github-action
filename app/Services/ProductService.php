<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductRestock;
use App\Services\AttachmentService;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class ProductService
{
    /**
     * The attachment service instance.
     *
     * @var AttachmentService
     */
    protected $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }
    //  /**
    //  * Get all products with optional filtering.
    //  *
    //  * @param array $filters
    //  * @return \Illuminate\Database\Eloquent\Collection
    //  */
    // public function getAllProducts(array $filters = [])
    // {
    //     $query = Product::query();

    //     // Apply status filter
    //     if (isset($filters['status']) && $filters['status']) {
    //         $query->where('status', $filters['status']);
    //     }

    //     // Apply category filter
    //     if (isset($filters['category_id']) && $filters['category_id']) {
    //         $query->where('category_id', $filters['category_id']);
    //     }

    //     // Apply search filter
    //     if (isset($filters['search']) && $filters['search']) {
    //         $search = $filters['search'];
    //         $query->where(function($q) use ($search) {
    //             $q->where('name', 'like', "%{$search}%")
    //               ->orWhere('description', 'like', "%{$search}%");
    //         });
    //     }

    //     // Apply sorting
    //     $sortField = $filters['sort_field'] ?? 'created_at';
    //     $sortDirection = $filters['sort_direction'] ?? 'desc';
    //     $query->orderBy($sortField, $sortDirection);

    //     // Load relationships
    //     $query->with(['category', 'stocks']);

    //     return isset($filters['paginate']) ?
    //         $query->paginate($filters['paginate']) :
    //         $query->get();
    // }

    public function getAllProducts()
    {
        return Product::with(['category', 'stocks'])->get();
    }

    public function createRestockRecord($data)
    {
        try {
            // Find the product
            $product = Product::findOrFail($data['product_id']);
            // Create the restock record
            $restock = ProductRestock::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'quantity' => $data['quantity'],
                'previous_quantity' => $product->total_quantity,
                'new_quantity' => $product->total_quantity + $data['quantity'],
                'reference_number' => $data['reference_number'] ?? null,
                'status' => $data['status'] ?? 'completed',
                'notes' => $data['notes'] ?? null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to create restock record: ' . $e->getMessage());
            dd($e->getMessage());
            throw $e; // Re-throw to be caught by the controller
        }

        return $product;

        // return $this->restockProduct($product, $data['quantity']);
    }

    public function countAllCategories()
    {
        return Category::count();
    }

    public function getProductById($id)
    {
        return Product::with(['category', 'stocks', 'attachments'])->findOrFail($id);
    }

    public function getProductCategories()
    {
        return Category::all();
    }

    public function countAllProducts()
    {
        return Product::count();
    }

    public function restockProduct($product, $quantity)
    {
        // Update product stock
        if ($product->stock) {
            $product->stock->quantity += $quantity;
            $product->stock->save();
        } else {
            // If using direct stock column on product
            $product->stock += $quantity;
            $product->save();
        }
        return $product;
    }

    /**
     * Set an attachment as primary for a model.
     *
     * @param int $attachmentId The ID of the attachment to set as primary
     * @param Model $model The model to which the attachment belongs
     * @return bool Success status
     */

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function category()
    {
        return Category::all();
    }

    public function storeProduct(array $data)
    {
        // Create the product
        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'price' => $data['price'] ?? 0,
            'is_returnable' => $data['is_returnable'],
            'status' => $data['status'],
            'created_by' => 'KQ01563',
        ]);

        // Create stock entry with quantity if provided
        if (isset($data['quantity'])) {
            $product->stocks()->create([
                'quantity' => $data['quantity'],
            ]);
        }

        // Handle attachments if provided
        if (isset($data['attachments']) && !empty($data['attachments'])) {
            // dd($data['attachments']);
            if ($this->attachmentService) {
                $this->attachmentService->uploadMultiple(
                    $data['attachments'],
                    $product,
                    'products',
                    true, // first is primary
                );
            }
        }

        return $product;
    }

    public function updateProduct($id, array $data)
    {
        $product = Product::findOrFail($id);

        // Update product details
        $product->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'is_returnable' => $data['is_returnable'],
            'status' => $data['status'],
            'updated_by' => 'KQ01563',
        ]);

        // Handle stock updates
        if (isset($data['quantity'])) {
            $this->updateProductStock($product, $data['quantity']);
        }

        // Handle alert quantity updates
        if (isset($data['alert_quantity'])) {
            $this->updateProductAlertQuantity($product, $data['alert_quantity']);
        }

        // Process image deletions
        if (isset($data['delete_attachments'])) {
            foreach ($data['delete_attachments'] as $attachmentId) {
                $this->removeAttachment($attachmentId);
            }
        }

        // Process new image uploads - FIXED: Make this more robust
        if (isset($data['attachments']) && !empty($data['attachments'])) {
            if ($this->attachmentService) {
                // Check if there are existing attachments
                $hasPrimary = $product->attachments()->where('is_primary', true)->exists();

                // Log for debugging
                \Log::info('Uploading attachments. Has primary: ' . ($hasPrimary ? 'Yes' : 'No'));
                \Log::info('Number of attachments: ' . count($data['attachments']));

                $this->attachmentService->uploadMultiple(
                    $data['attachments'],
                    $product,
                    'products',
                    !$hasPrimary, // Only set first as primary if no primary exists
                );
            }
        }

        return $product;
    }

    public function removeAttachment($attachmentId)
    {
        try {
            $attachment = Attachment::findOrFail($attachmentId);

            // Delete the physical file
            if (Storage::disk('public')->exists($attachment->path)) {
                Storage::disk('public')->delete($attachment->path);
            }

            // Delete the record from the database
            return $attachment->delete();
        } catch (\Exception $e) {
            \Log::error('Failed to remove attachment: ' . $e->getMessage());
            throw $e; // Re-throw to be caught by the controller
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    protected function updateProductStock($product, $newQuantity)
    {
        try {
            // Get the first stock record or create a new one
            $stock = $product->stocks()->first();

            if ($stock) {
                $result = $stock->update(['quantity' => $newQuantity]);
                \Log::info("Stock updated for product #{$product->id}: new quantity = {$newQuantity}");
            } else {
                $stock = $product->stocks()->create([
                    'quantity' => $newQuantity,
                    // 'created_by' => 'KQ01563',
                ]);
                \Log::info("Stock created for product #{$product->id}: quantity = {$newQuantity}");
            }

            return true;
        } catch (\Exception $e) {
            \Log::error("Stock update failed for product #{$product->id}: " . $e->getMessage());
            return false;
        }
    }

    protected function updateProductAlertQuantity($product, $newAlertQuantity)
    {
        try {
            // Get the first stock record or create a new one
            $stock = $product->stocks()->first();

            if ($stock) {
                $result = $stock->update(['alert_quantity' => $newAlertQuantity]);
                \Log::info("Alert quantity updated for product #{$product->id}: new alert quantity = {$newAlertQuantity}");
            } else {
                $stock = $product->stocks()->create([
                    'alert_quantity' => $newAlertQuantity,
                    // 'created_by' => 'KQ01563',
                ]);
                \Log::info("Stock created for product #{$product->id} with alert quantity = {$newAlertQuantity}");
            }

            return true;
        } catch (\Exception $e) {
            \Log::error("Alert quantity update failed for product #{$product->id}: " . $e->getMessage());
            return false;
        }
    }

    public function getLowStockProducts()
    {
        $lowStockProducts = Product::with(['category', 'stocks'])
            ->get()
            ->filter(function ($product) {
                return $product->total_quantity <= ($product->stocks->alert_quantity ?? 5);
            })
            ->sortBy('total_quantity')
            ->values();

            return $lowStockProducts;
        //   return Product::query()
        // ->whereHas('stocks', function ($query) {
        //     // Use the correct column name from product_stocks table
        //     $query->whereRaw('product_stocks.quantity <= product_stocks.alert_quantity');
        // })
        // // For products without stocks relationship or alert_quantity
        // ->orWhereHas('stocks', function ($query) {
        //     $query->where('quantity', '<=', 5);
        // })
        // ->with(['category', 'stocks'])
        // ->orderBy('stocks.quantity', 'asc')
        // ->get();
    }
}
