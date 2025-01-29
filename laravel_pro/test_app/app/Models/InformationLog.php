<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationLog extends Model
{
    use HasFactory;

    protected $table = 'information_log';

    protected $primaryKey = 'information_log_id';
}
