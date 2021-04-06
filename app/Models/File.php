<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Add override for default delete function so we delete the physical file as well
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        Storage::delete($this->path);
        return parent::delete();
    }

    /*
     * GETTERS
     */

    public function getUrlAttribute() {
        return route('file.fetch', ['id' => $this->id]);
    }
}
