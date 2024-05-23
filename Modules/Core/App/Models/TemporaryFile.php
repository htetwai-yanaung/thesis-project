<?php

namespace Modules\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Database\factories\TemporaryFileFactory;

class TemporaryFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['folder', 'file'];

    const id = 'id';
    const folder = 'folder';
    const file = 'file';
}
