<?php

namespace Modules\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Database\factories\NewsFactory;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'description', 'user_id'];

    public function images(){
        return $this->hasMany(Image::class, 'parent_id', 'id');
    }

}
