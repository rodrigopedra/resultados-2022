<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="60" />

    <title>Resultados - 2022</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>
<main class="container my-4">
    <header class="d-flex align-items-end mb-3">
        <h1 class="mb-0">Resultados 2022</h1>

        <span class="ms-3">
            Urnas apuradas: {{ \number_format($apuracao['urnas_apuradas'] ?? 0.0, 2, ',', '.') }}%
        </span>
    </header>

    <section class="card">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th class="text-center">Número</th>
                        <th>Nome</th>
                        <th style="width: 1%">Gráfico</th>
                        <th class="text-center">Votos</th>
                        <th class="text-center">%</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resultados as $resultado)
                        <tr>
                            <th class="text-center" scope="row">{{ $resultado['numero'] }}</th>
                            <td>{{ \html_entity_decode($resultado['nome']) }}</td>
                            <td>
                                @if($maior > 0)
                                    <svg viewBox="0 0 100 10" xmlns="http://www.w3.org/2000/svg" height="16">
                                        <rect width="{{ \number_format($resultado['votos'] * 100 / $maior, 1) }}"
                                              height="10" fill="DeepSkyBlue" />
                                    </svg>
                                @endif
                            </td>
                            <td class="text-center">{{ \number_format($resultado['votos'], 0, ',', '.') }}</td>
                            <td class="text-center">{{ \number_format($resultado['percentual'], 2, ',', '.') }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">
                                <em class="text-muted">Nenhum resultado baixado</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
