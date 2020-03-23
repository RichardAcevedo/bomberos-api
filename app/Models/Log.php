<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'id', 'user_type', 'user_id', 'event', 'auditable', 'old_values', 'new_values',
        'url', 'ip_address', 'user_agent', 'tags'
    ];
}
