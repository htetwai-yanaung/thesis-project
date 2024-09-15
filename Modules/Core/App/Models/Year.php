<?php

namespace Modules\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id', 'year', 'status'];

    protected $table = 'years';

    const tableName = 'years';
    const id = 'id';
    const year = 'year';
    const status = 'status';
    const createdAt = 'created_at';

    protected static function newFactory()
    {
        // return YearFactory::new();
    }
}
