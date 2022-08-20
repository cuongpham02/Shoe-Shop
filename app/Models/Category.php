<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, softDeletes;

    protected $primaryKey = 'id';

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'desc', 'status', 'parent_id'
    ];

    public function product(){

        return $this->hasMany(Product::class,'category_id','id');
    }
}
