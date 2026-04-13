<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'enseignant_id', 'actif'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['actif' => 'boolean', 'password' => 'hashed'];

    // Helpers rôles
    public function isAdmin()       { return $this->role === 'admin'; }
    public function isAgent()       { return $this->role === 'agent'; }
    public function isResponsable() { return $this->role === 'responsable'; }
    public function isEnseignant()  { return $this->role === 'enseignant'; }

    // Relations
    public function enseignant()          { return $this->belongsTo(Enseignant::class); }
    public function notesEnvoyees()       { return $this->hasMany(NoteInterne::class, 'expediteur_id'); }
    public function notesRecues()         { return $this->hasMany(NoteInterne::class, 'destinataire_id'); }
    public function notesNonLues()        { return $this->hasMany(NoteInterne::class, 'destinataire_id')->where('lu', false); }
}
