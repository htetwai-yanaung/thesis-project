<?php

namespace Modules\Core\App\Models;

use App\Models\User;
use Modules\Core\App\Models\Image;
use Modules\Core\Constant\Constants;
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
        'category_id',
        'year_id',
        'project_type',
        'member',
        'user_id',
        'status',
    ];

    const tableName = 'thesis_projects';
    const id = 'id';
    const title = 'title';
    const desc = 'description';
    const categoryId = 'category_id';
    const yearId = 'year_id';
    const projectType = 'project_type';
    const member = 'member';
    const userId = 'user_id';
    const status = 'status';

    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images(){
        return $this->hasMany(Image::class, 'parent_id', 'id')->where(Image::imageType, Constants::projectImageType);
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
