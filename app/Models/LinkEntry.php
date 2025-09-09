<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkEntry extends Model
{
    protected $table = 'link_entries';
    protected $fillable = ['user_id', 'platform', 'url'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
