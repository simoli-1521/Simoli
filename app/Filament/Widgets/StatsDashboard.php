<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
// use App\Models\Tugas;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        // $countTugas = Tugas::count();
        // return [
        //     Stat::make('Jumlah Tugas', $countTugas),
        // ];
        return[];
    }
}
