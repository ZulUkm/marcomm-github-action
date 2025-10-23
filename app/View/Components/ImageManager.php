<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageManager extends Component
{
    public $attachments;
    public $id;
    public $uploadText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attachments = [], $id = null, $uploadText = 'Add Images')
    {
        $this->attachments = $attachments;
        $this->id = $id ?? uniqid('image-manager-');
        $this->uploadText = $uploadText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image-manager');
    }
}