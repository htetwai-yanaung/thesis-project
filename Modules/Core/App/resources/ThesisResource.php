<?php

namespace Modules\Core\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThesisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'year_id' => $this->year_id,
            'project_type' => $this->project_type,
            'member' => $this->member,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'owner' => $this->owner->toArray(),
            'images' => ImageResource::collection(count($this->images) > 0 ? $this->images : $this->getEmptyImageResource())->toArray(request()),
            'category' => $this->category,
            'pdfs' => $this->pdfs,
            'created_at' => $this->created_at->format('d/m/Y')
        ];
    }

    private function getEmptyImageResource()
    {
        $array[] = [
            'id' => "",
            'parent_id' => "",
            'image_type' => "",
            'file_type' => "",
            'path' => "",
            'ordering' => "",
            'created_at' => "",
        ];
        return $array;
    }
}
