<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BaixaVotos extends Command
{
    private const URL = 'https://resultados.tse.jus.br/oficial/ele2022/544/dados-simplificados/br/br-c0001-e000544-r.json';

    protected $signature = 'app:baixa-votos';

    protected $description = 'Baixa os votos do TSE e salva como JSON';

    public function handle(): int
    {
        $resposta = Http::retry(3, 10_000)->get(self::URL);

        $registros = \collect($resposta->json('cand', []))
            ->map(static fn (array $registro, int $index) => [
                'id' => \intval($registro['seq'] ?? $index),
                'numero' => \intval($registro['n'] ?? 0),
                'nome' => $registro['nm'] ?? '',
                'votos' => \intval($registro['vap'] ?? 0),
                'percentual' => Str::of($registro['pvap'] ?? '0,0')->replace(',', '.')->toFloat(),
            ])
            ->reject(static fn (array $registro) => $registro['id'] === 0)
            ->values();

        if ($registros->isEmpty()) {
            return Command::FAILURE;
        }

        Storage::drive('local')->put('votos.json', \json_encode($registros->all(), \JSON_THROW_ON_ERROR));

        return Command::SUCCESS;
    }
}
