<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Display extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function image() {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function displayType() {
        return $this->belongsTo(DisplayType::class, 'display_type_id', 'id');
    }

    public function reseller() {
        return $this->belongsTo(Reseller::class, 'reseller_id', 'id');
    }
}
