<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getDataDashboard(string $platform, string $field = 'item_out')
    {
        $data = $this->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('SUM(item_out) as quantity'))
            ->where('platform', $platform)
            ->whereYear('created_at', now()->year)
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->orderBy(\DB::raw('MONTH(created_at)'))
            ->get();

        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];

        $result = [];

        foreach ($data as $item) {
            $result[] = [
                'month' => $months[$item->month],
                'quantity' => $item->quantity,
            ];
        }

        return $result;
    }
    public function sumData(string $platform)
    {
        return $this->where('platform', $platform)
            ->whereYear('created_at', now()->year)
            ->sum('item_out');
    }
}
