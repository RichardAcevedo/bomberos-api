<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdodbLogsql extends Model
{
    protected $table = 'adodb_logsql';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'sql0', 'sql1', 'params', 'tracer', 'timer'
    ];
}
