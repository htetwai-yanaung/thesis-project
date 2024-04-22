<?php

namespace Modules\Core\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Database\factories\ThesisProjectFactory;

class ThesisProject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'year',
        'project_type',
        'member',
        'user_id',
    ];

    const id = 'id';
    const title = 'title';
    const desc = 'description';
    const year = 'year';
    const projectType = 'project_type';
    const member = 'member';
    const userId = 'user_id';

    public function owner(){
        return $this->belongsTo(User::class);
    }
}
