<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title', 'description', 'price','user_id','categorie_id'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie');
    }

}
