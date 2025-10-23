<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;

    /**
     * Constructor with dependency injection
     */ 
    public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        //$this->middleware('role:admin', ['only' => ['index', 'store']]);
        $this->productService = $productService;
    }

    public function index()
    {
       
        $products = $this->productService->getAllProducts();

        return view('product.index', compact('products'));
    }

    public function lowStockProducts()
    {
        // echo "low stock products";die;
        // $products = $this->productService->getLowStockProducts();

        return view('product.index_low_stocks');
    }

    public function restock(Request $request)
    {
        // echo "restock function called";die;
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'reference_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:255',
        ]);

        try{

            DB::beginTransaction();

            $product = $this->productService->createRestockRecord($data);

            $this->productService->restockProduct($product, $data['quantity']);

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product restocked successfully.');

        }catch(\Exception $e){

            dd($e->getMessage());
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors('error', 'Failed to restock product: ' . $e->getMessage());
        }

        // try {
        //     $this->productService->restockProduct($validatedData);
        //     return redirect()->route('products.index')->with('success', 'Product restocked successfully.');
        // } catch (\Exception $e) {
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with('error', 'Failed to restock product: ' . $e->getMessage());
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->productService->category();

        return view('product.create_product', compact('categories'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required',
            'is_returnable' => 'required|boolean',
            'status' => 'required|string|in:active,inactive',
            'attachments' => 'array',
            'attachments.*' => 'file|mimes:jpeg,jpg|max:2048',
            'quantity' => 'nullable|integer|min:0',
        ]);

    

        $product = $this->productService->storeProduct($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->productService->category();

        return view('product.edit', compact('product', 'categories'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'nullable|string',
            //'quantity' => 'required|integer|min:0',
            'alert_quantity' => 'required|integer|min:0',
            'is_returnable' => 'required|boolean',
            'status' => 'required|in:active,inactive',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpeg,jpg,png|max:2048',
            'delete_attachments' => 'nullable|array',
            'delete_attachments.*' => 'integer|exists:attachments,id',
        ]);


        try {
            // Process image removal BEFORE updating the product
            if ($request->has('remove_attachments')) {
                // Check if we're receiving the deletion data
                \Log::info('Delete attachments:', [$request->delete_attachments ?? 'None']);

                // Add debugging for troubleshooting
                \Log::info('Removing attachments: ' . json_encode($request->remove_attachments));

                foreach ($request->remove_attachments as $attachmentId) {
                    $result = $this->productService->removeAttachment($attachmentId);
                    \Log::info("Removed attachment $attachmentId: " . ($result ? 'success' : 'failed'));
                }
            }

            // Explicitly log whether we have new attachments
        if ($request->hasFile('attachments')) {
            
            $fileCount = count($request->file('attachments'));
            \Log::info("New attachments detected: {$fileCount} files");
            // dd($request->file('attachments'));
            // Make sure attachments are included in validated data
            $validatedData['attachments'] = $request->file('attachments');
        } else {
            \Log::info("No new attachments in request");
        }

      
            // Update the product
            $product = $this->productService->updateProduct($id, $validatedData);

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating product: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update product: ' . $e->getMessage());
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
