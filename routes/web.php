<?php

use App\Models\Resultado;
use Illuminate\Support\Facades\Route;

Route::view('/', 'resultados', [
    'resultados' => Resultado::query()
        ->orderByDesc('percentual')
        ->orderByDesc('votos')
        ->orderBy('numero')
        ->get(),
    'maior' => \intval(Resultado::query()->max('votos') ?? 0),
]);
