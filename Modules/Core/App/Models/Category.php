<?php

namespace Modules\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Database\factories\ImageFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id', 'name', 'description', 'status', 'created_at', 'updated_at'];

    protected $table = 'categories';

    const id = 'id';
    const name = 'name';
    const description = 'description';
    const status = 'status';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';

}
