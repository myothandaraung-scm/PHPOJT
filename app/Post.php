<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title', 
        'description',
        'status',
        'create_user_id',
        'updated_user_id'
        
    ];

    protected $date = [
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
