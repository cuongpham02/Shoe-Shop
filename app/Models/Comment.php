<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, softDeletes;

    protected $primaryKey = 'id';

    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'status', 'product_id', 'rep_comment'
    ];

    public function product(){

        return $this->belongsto(Product::class,'product_id','id');
    }
}
