<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'bitcoin_setting';
    protected $fillable = [
        'user_id', 'address','receive_email', 'password', 'otp_key','receive_email_two'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}