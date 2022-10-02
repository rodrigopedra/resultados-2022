<?php

use App\Models\Apuracao;
use App\Models\Resultado;
use Illuminate\Support\Facades\Route;

Route::view('/', 'resultados', [
    'apuracao' => Apuracao::query()->firstOr(static fn () => new Apuracao()),
    'resultados' => Resultado::query()
        ->orderByDesc('percentual')
        ->orderByDesc('votos')
        ->orderBy('numero')
        ->get(),
    'maior' => \intval(Resultado::query()->max('votos') ?? 0),
]);
