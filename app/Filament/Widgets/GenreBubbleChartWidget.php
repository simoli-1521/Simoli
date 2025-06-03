<?php

namespace App\Filament\Widgets;

use App\Models\KategoriBuku;
use App\Models\BookModel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class GenreBubbleChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Popularitas Genre Buku';
    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Get all categories with their book counts
        $categories = KategoriBuku::withCount('books')
            ->orderBy('books_count', 'desc')
            ->get();

        // Prepare data for bar chart
        $labels = $categories->pluck('nama_kategori')->toArray();
        $bookCounts = $categories->pluck('books_count')->toArray();
        
        // Generate different colors for each category
        $colors = $this->generateColors(count($categories));
        
        // Create the dataset
        $datasets = [
            [
                'label' => 'Jumlah Buku',
                'data' => $bookCounts,
                'backgroundColor' => $colors,
                'borderWidth' => 2, // Updated to match BarBukuRusak
                'size' => 16, // Ensuring size consistency
            ]
        ];
        
        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function generateColors(int $count): array
    {
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = sprintf('rgba(%d, %d, %d, 0.6)', rand(0, 255), rand(0, 255), rand(0, 255));
        }
        return $colors;
    }
}
