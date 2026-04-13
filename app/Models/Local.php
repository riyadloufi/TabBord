<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locaux';
    protected $fillable = ['code', 'nom', 'type', 'capacite', 'nbr_ordinateurs', 'nbr_tableaux', 'disponible'];
    protected $casts = ['disponible' => 'boolean'];

    public function ressources() { return $this->hasMany(RessourceMaterielle::class, 'local_id'); }
}
