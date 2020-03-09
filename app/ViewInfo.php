<?php


namespace App;

use Arcanedev\Support\Database\Model;

class ViewInfo extends Model
{
    protected $table = 'view_information';
    protected $fillable = [
        'about_us', 'address','phone', 'fax', 'email',
        'skype', 'instagram', 'home_photo', 'news_content'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}