<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxItem extends Model
{
    use HasFactory;

    protected $table = 'box_items';
    protected $guarded = ['id'];

    public function drawbox()
    {
        return $this->belongsTo(Drawbox::class, 'drawbox_id');
    }
}
