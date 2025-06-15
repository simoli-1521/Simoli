<?php

namespace App\Filament\Keuangan\Widgets;

use App\Models\Reimburse;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JenisReimburseChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $reimburse = Reimburse::query()
        ->selectRaw('jenis_reimburse, COUNT(*) as total')
        ->groupBy('jenis_reimburse')
        ->orderByDesc('total')
        ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jenis Reimburse',
                    'data' => $reimburse->pluck('total'),
                    'backgroundColor' => [
                        '#36A2EB', // Blue
                        '#FF6384', // Red
                        '#FFCE56', // Yellow
                        '#4BC0C0', // Teal
                        '#9966FF', // Purple
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $reimburse->pluck('jenis_reimburse')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
