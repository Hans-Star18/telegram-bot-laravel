<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drawbox extends Model
{
    use HasFactory;

    protected $table = 'drawboxs';
    protected $guarded = ['id'];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function boxItems()
    {
        return $this->hasMany(BoxItem::class);
    }
}
