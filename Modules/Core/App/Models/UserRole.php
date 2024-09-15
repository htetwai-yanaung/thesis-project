<?php

namespace Modules\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['id', 'role', 'status'];

    protected $table = 'user_roles';

    const tableName = 'user_roles';
    const id = 'id';
    const role = 'role';
    const status = 'status';
    const createdAt = 'created_at';

    protected static function newFactory()
    {
        // return UserRoleFactory::new();
    }
}
