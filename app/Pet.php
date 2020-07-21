<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name', 'description', 'age', 'user_id'
    ];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
