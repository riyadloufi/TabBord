<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteInterne extends Model
{
    protected $table = 'notes_internes';
    protected $fillable = ['expediteur_id', 'destinataire_id', 'contenu', 'lu'];
    protected $casts = ['lu' => 'boolean'];

    public function expediteur()   { return $this->belongsTo(User::class, 'expediteur_id'); }
    public function destinataire() { return $this->belongsTo(User::class, 'destinataire_id'); }
}
