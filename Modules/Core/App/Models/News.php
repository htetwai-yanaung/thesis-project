<?php

namespace Modules\Core\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\factories\NewsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'description', 'user_id'];

    protected $table = 'news';

    const tableName = 'news';
    const id = 'id';
    const title = 'title';
    const description = 'description';
    const userId = 'user_id';
    const createdAt = 'created_at';

    protected static function newFactory()
    {
        return NewsFactory::new();
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'parent_id', 'id')->where('image_type', 'news');
    }

}
