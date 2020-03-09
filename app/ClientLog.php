<?php


namespace App;


use Arcanedev\Support\Database\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ClientLog extends Model
{
    protected $table = "log_client";
    protected $fillable = [
        "ipaddress"
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}