<?php

namespace Modules\Core\App\resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => isset($this->id) ? $this->id : "",
            'parent_id' => isset($this->parent_id) ? $this->parent_id : "",
            'image_type' => isset($this->image_type) ? $this->image_type : "",
            'file_type' => isset($this->file_type) ? $this->file_type : "",
            'path' => isset($this->path) ? $this->path : "",
            'ordering' => isset($this->ordering) ? $this->ordering : "",
            'created_at' => isset($this->created_at) ? $this->created_at->format('d/m/Y') : "",
        ];
    }
}
