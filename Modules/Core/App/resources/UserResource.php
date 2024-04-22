<?php

namespace Modules\Core\App\resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'year' => isset($this->year)?toYear($this->year):'',
            'profile_photo_path' => $this->profile_photo_path,
            'created_at' => $this->created_at->format('d/m/Y')
        ];
    }
}
