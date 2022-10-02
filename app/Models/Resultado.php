<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Sushi\Sushi;

class Resultado extends Model
{
    use Sushi;

    protected $casts = [
        'id' => 'integer',
        'numero' => 'integer',
        'votos' => 'integer',
        'percentual' => 'decimal:2',
    ];

    protected array $schema = [
        'id' => 'integer',
        'numero' => 'integer',
        'nome' => 'string',
        'votos' => 'integer',
        'percentual' => 'float',
    ];

    public function getRows()
    {
        if (! Storage::drive('local')->exists('votos.json')) {
            return [];
        }

        $json = Storage::drive('local')->get('votos.json');

        return \collect(\json_decode($json, true, 512, \JSON_THROW_ON_ERROR))
            ->values()
            ->all();
    }

    protected function sushiShouldCache(): bool
    {
        if (! Storage::drive('local')->exists('votos.json')) {
            return false;
        }

        return true;
    }

    protected function sushiCacheReferencePath(): string
    {
        return \storage_path('app/votos.json');
    }
}
