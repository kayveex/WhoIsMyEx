<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExLists extends Model
{
    use HasFactory;

    protected $table = 'ex_lists';
    protected $id = 'id'; //PrimaryKey
    protected $fillable = ['nama', 'fotoMantan', 'status', 'lama_pacaran'];

}
