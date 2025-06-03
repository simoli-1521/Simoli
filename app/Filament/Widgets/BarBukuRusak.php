<?php

namespace App\Filament\Widgets;

use App\Models\LogBuku;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BarBukuRusak extends ChartWidget
{
    protected static ?string $heading = 'Pengurangan Stok Buku (6 Bulan Terakhir)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Get the last 6 months (current month and 5 previous)
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i));
        }

        // Format the months and get reduction counts
        $monthLabels = $months->map(fn ($month) => $month->format('M Y'))->toArray();
        
        // Query to get log count by month
        $reductionData = LogBuku::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->whereDate('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->whereDate('created_at', '<=', now()->endOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        // Map the data to the months
        $counts = [];
        foreach ($months as $date) {
            $month = (int) $date->format('m');
            $year = (int) $date->format('Y');
            
            $match = $reductionData->first(function ($item) use ($month, $year) {
                return $item->month == $month && $item->year == $year;
            });
            
            $counts[] = $match ? $match->count : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengurangan Stok',
                    'data' => $counts,
                    'borderColor' => 'rgb(54, 162, 235)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $monthLabels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0, // Show only integer values
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false, // Hide legend since we only have one dataset
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => "function(context) {
                            return ' ' + context.parsed.y + ' buku';
                        }",
                    ],
                ],
            ],
        ];
    }
}
