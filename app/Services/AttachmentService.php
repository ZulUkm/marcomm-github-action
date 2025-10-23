<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class AttachmentService
{
    /**
     * Upload multiple files and attach them to a model.
     *
     * @param array $files Array of UploadedFile objects
     * @param Model $model The model to attach files to
     * @param string $directory Directory to store files in
     * @param bool $firstIsPrimary Set first attachment as primary
     * @return array Array of created attachment models
     */
    public function uploadMultiple(array $files, Model $model, string $directory = 'uploads', bool $firstIsPrimary = true)
    {
        $attachments = [];
        $isPrimary = $firstIsPrimary;
        $displayOrder = 0;

        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $attachment = $this->uploadSingle($file, $model, $directory, $isPrimary, $displayOrder);
                $attachments[] = $attachment;
                
                // Only first attachment is primary
                if ($isPrimary) {
                    $isPrimary = false;
                }
                
                $displayOrder++;
            }
        }

        return $attachments;
    }

    /**
     * Upload a single file and attach it to a model.
     *
     * @param UploadedFile $file The file to upload
     * @param Model $model The model to attach the file to
     * @param string $directory Directory to store file in
     * @param bool $isPrimary Set as primary attachment
     * @param int $displayOrder Display order for the attachment
     * @return Attachment The created attachment model
     */
    public function uploadSingle(UploadedFile $file, Model $model, string $directory = 'uploads', bool $isPrimary = true, int $displayOrder = 0)
    {
        // Generate a unique filename
        $originalName = $file->getClientOriginalName();
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        
        // Store the file
        $path = $file->storeAs($directory, $fileName, 'public');
        
        // Create attachment record
        $attachment = new Attachment([
            'original_filename' => $originalName,
            'filename' => $fileName,
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'is_primary' => $isPrimary,
            'display_order' => $displayOrder,
            'created_by' => auth()->user()->name ?? 'system',
        ]);
        
        // Save the attachment to the model
        $model->attachments()->save($attachment);
        
        return $attachment;
    }

    /**
     * Delete an attachment and its associated file.
     *
     * @param int $attachmentId The attachment ID to delete
     * @return bool Success status
     */
    public function deleteAttachment(int $attachmentId): bool
    {
        try {
            $attachment = Attachment::findOrFail($attachmentId);
            
            // Delete the file from storage
            if (Storage::disk('public')->exists($attachment->path)) {
                Storage::disk('public')->delete($attachment->path);
            }
            
            // Delete the record
            return $attachment->delete();
            
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Set an attachment as the primary one for its model.
     *
     * @param int $attachmentId The attachment ID to make primary
     * @return bool Success status
     */
    public function setPrimaryAttachment(int $attachmentId): bool
    {
        try {
            $attachment = Attachment::findOrFail($attachmentId);
            
            // Find all attachments for the same model
            $modelAttachments = Attachment::where('attachable_type', $attachment->attachable_type)
                ->where('attachable_id', $attachment->attachable_id)
                ->get();
            
            // Update all attachments for the model
            foreach ($modelAttachments as $modelAttachment) {
                $modelAttachment->is_primary = ($modelAttachment->id === $attachment->id);
                $modelAttachment->save();
            }
            
            return true;
            
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Update display order for attachments.
     *
     * @param array $orderData Array of [id => order] pairs
     * @return bool Success status
     */
    public function updateAttachmentsOrder(array $orderData): bool
    {
        try {
            foreach ($orderData as $id => $order) {
                $attachment = Attachment::find($id);
                if ($attachment) {
                    $attachment->display_order = $order;
                    $attachment->save();
                }
            }
            
            return true;
            
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Get all attachments for a model.
     *
     * @param Model $model The model to get attachments for
     * @param bool $orderByDisplay Whether to order by display_order
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getModelAttachments(Model $model, bool $orderByDisplay = true)
    {
        $query = $model->attachments();
        
        if ($orderByDisplay) {
            $query->orderBy('display_order');
        }
        
        return $query->get();
    }

    /**
     * Get the primary attachment for a model.
     *
     * @param Model $model The model to get the primary attachment for
     * @return Attachment|null
     */
    public function getPrimaryAttachment(Model $model)
    {
        return $model->attachments()
            ->where('is_primary', true)
            ->first() ?? $model->attachments()->first();
    }

    /**
     * Generate a thumbnail for an image attachment.
     *
     * @param Attachment $attachment The attachment to generate thumbnail for
     * @param int $width Thumbnail width
     * @param int $height Thumbnail height
     * @return string|null Path to thumbnail or null on failure
     */
    public function generateThumbnail(Attachment $attachment, int $width = 200, int $height = 200)
    {
        try {
            // Check if it's an image
            if (!Str::startsWith($attachment->mime_type, 'image/')) {
                return null;
            }
            
            // Get original image path
            $originalPath = Storage::disk('public')->path($attachment->path);
            
            // Generate thumbnail filename
            $thumbnailFilename = 'thumb_' . $width . 'x' . $height . '_' . $attachment->filename;
            $thumbnailPath = dirname($attachment->path) . '/thumbnails/' . $thumbnailFilename;
            $thumbnailFullPath = Storage::disk('public')->path(dirname($thumbnailPath));
            
            // Create directory if it doesn't exist
            if (!file_exists($thumbnailFullPath)) {
                mkdir($thumbnailFullPath, 0755, true);
            }
            
            // Load the image
            $img = \Image::make($originalPath);
            
            // Create thumbnail
            $img->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Save thumbnail
            $img->save(Storage::disk('public')->path($thumbnailPath));
            
            return $thumbnailPath;
            
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }
}