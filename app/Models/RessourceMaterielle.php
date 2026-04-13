<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RessourceMaterielle extends Model
{
    protected $table = 'ressources_materielles';
    protected $fillable = ['local_id', 'designation', 'categorie', 'quantite', 'etat', 'notes'];

    public function local() { return $this->belongsTo(Local::class); }
}
