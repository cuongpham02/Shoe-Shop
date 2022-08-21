<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'role_name', 'desc'
    ];
    protected $primaryKey = 'id';
    protected $table = 'roles';

    /**
     * function relationship user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class,'user_role','role_id','user_id');
    }

    /**
     * function relationship permission
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permission(){
        return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id');
    }
}
