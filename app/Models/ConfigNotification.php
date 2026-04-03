<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigNotification extends Model
{
    protected $table ='config_notification';
    protected $fillable = [
        'max_value',
        'min_value',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
