<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenReport extends Model
{
    use HasFactory;

    protected $table = 'token_reports';
    protected $guarded = ['id'];

    public function token()
    {
        return $this->belongsTo(Token::class, 'token_id');
    }

    public function item()
    {
        return $this->belongsTo(BoxItem::class, 'box_item_id');
    }
}
