<?php

namespace App\Imports\Product;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LazadaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            if ($index > 0) {
                $sku = $row[5];

                $extProduct = \DB::table('products')
                    ->where('sku', $sku)
                    ->where('platform', 'lazada')
                    ->latest()
                    ->first();

                if ($extProduct) {
                    $currMonth = Carbon::now()->month;
                    $stockMonth = Carbon::parse($extProduct->created_at)->month;

                    if ($stockMonth == $currMonth) {
                        \DB::table('products')
                            ->where('id', $extProduct->id)
                            ->update([
                                'item_out' => $extProduct->item_out + 1
                            ]);
                    } else {
                        \DB::table('products')->insert([
                            'sku' => $sku,
                            'platform' => 'lazada',
                            'item_out' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                } else {
                    \DB::table('products')->insert([
                        'sku' => $sku,
                        'platform' => 'lazada',
                        'item_out' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
