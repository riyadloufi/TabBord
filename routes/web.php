<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    EtudiantController,
    ValidationController,
    EnseignantController,
    LocalController,
    NoteInterneController,
    ExportController,
    UserController
};

// ── Auth ─────────────────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Authentifié ──────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/', fn() => redirect()->route('dashboard'));

    // Dashboard — tous les rôles
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── Admin ─────────────────────────────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    // ── Agent admin ───────────────────────────────────────────────────────
    Route::middleware('role:agent,admin')->prefix('gestion')->name('gestion.')->group(function () {
        Route::resource('etudiants', EtudiantController::class);
        Route::resource('validations', ValidationController::class);
        Route::resource('enseignants', EnseignantController::class);
        Route::resource('locaux', LocalController::class);
    });

    // ── Responsable ───────────────────────────────────────────────────────
    Route::middleware('role:responsable,admin')->prefix('stats')->name('stats.')->group(function () {
        Route::get('etudiants', [EtudiantController::class, 'index'])->name('etudiants');
        Route::get('etudiants/achevale', [EtudiantController::class, 'achevale'])->name('achevale');
        Route::get('validations', [ValidationController::class, 'index'])->name('validations');

        // Exports
        Route::get('export/inscriptions-pdf', [ExportController::class, 'pdfInscriptions'])->name('export.inscriptions');
        Route::get('export/validations-pdf', [ExportController::class, 'pdfValidations'])->name('export.validations');
    });

    // ── Enseignant ────────────────────────────────────────────────────────
    Route::middleware('role:enseignant,responsable,admin')->group(function () {
        Route::get('locaux', [LocalController::class, 'index'])->name('locaux.index');
        Route::get('validations', [ValidationController::class, 'index'])->name('validations.index');
    });

    // ── Notes internes (responsable ↔ agent) ─────────────────────────────
    Route::middleware('role:responsable,agent,admin')->group(function () {
        Route::get('notes', [NoteInterneController::class, 'index'])->name('notes.index');
        Route::post('notes', [NoteInterneController::class, 'store'])->name('notes.store');
    });
});
