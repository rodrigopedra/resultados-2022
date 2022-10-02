<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Sushi\Sushi;

class Apuracao extends Model
{
    use Sushi;

    protected $casts = [
        'id' => 'integer',
        'eleitores' => 'integer',
        'urnas_apuradas' => 'decimal:2',
    ];

    protected array $schema = [
        'id' => 'integer',
        'eleitores' => 'integer',
        'urnas_apuradas' => 'float',
    ];

    public function getRows(): array
    {
        if (! Storage::drive('local')->exists('apuracao.json')) {
            return [];
        }

        $json = Storage::drive('local')->get('apuracao.json');

        return \collect(\json_decode($json, true, 512, \JSON_THROW_ON_ERROR))
            ->values()
            ->all();
    }

    protected function sushiShouldCache(): bool
    {
        if (! Storage::drive('local')->exists('apuracao.json')) {
            return false;
        }

        return true;
    }

    protected function sushiCacheReferencePath(): string
    {
        return \storage_path('app/apuracao.json');
    }
}
