<?php

namespace App\Imports\Product;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TiktokImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            if ($index > 1) {
                $sku = $row[6] . ' ' . $row[8];
                $item_out = $row[9];

                $extProduct = \DB::table('products')
                    ->where('sku', $sku)
                    ->where('platform', 'tiktok')
                    ->latest()
                    ->first();

                if ($extProduct) {
                    $currMonth = Carbon::now()->month;
                    $stockMonth = Carbon::parse($extProduct->created_at)->month;

                    if ($stockMonth == $currMonth) {
                        \DB::table('products')
                            ->where('id', $extProduct->id)
                            ->update([
                                'item_out' => $extProduct->item_out + $item_out
                            ]);
                    } else {
                        \DB::table('products')->insert([
                            'sku' => $sku,
                            'platform' => 'tiktok',
                            'item_out' => $item_out,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                } else {
                    \DB::table('products')->insert([
                        'sku' => $sku,
                        'platform' => 'tiktok',
                        'item_out' => $item_out,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
