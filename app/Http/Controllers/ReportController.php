<?php

namespace App\Http\Controllers;

use App\Imports\Product\LazadaImport;
use App\Imports\Product\TiktokImport;
use App\Models\Stock;
use Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\Product\ShopeeImport;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $products = $this->fetchProducts($request);

        return view('pages.report.index', compact('products'));
    }

    public function search(Request $request)
    {
        $products = $this->fetchProducts($request);

        return view('pages.report.products_table', compact('products'));
    }

    private function fetchProducts(Request $request)
    {
        $query = \DB::table('products')
            ->select(
                '*',
                \DB::raw('SUM(stock_opname + item_in - item_out) AS total_stock'),
                \DB::raw('SUM(CASE WHEN YEARWEEK(created_at,1) = YEARWEEK(NOW(),1) THEN item_out ELSE 0 END) AS dw')
            )
            ->whereRaw('MONTH(created_at) = MONTH(NOW())')
            ->groupBy('id');

        if ($request->filled('platform')) {
            $query->where('platform', $request->platform);
        } else {
            $query->where('platform', 'shopee');
        }

        if ($request->has('search')) {
            $searchKeyword = $request->search;
            $query->where(function ($q) use ($searchKeyword) {
                $q->where('sku', 'like', "%$searchKeyword%");
            });
        }

        return $query->get();
    }
    public function edit(Request $request)
    {
        try {
            $request->validate([
                'stock_opname' => 'required|min:0',
                'item_in' => 'required|min:0',
                'item_out' => 'required|min:0',
            ]);

            \DB::table('products')
                ->where('id', $request->productId)
                ->update([
                    'stock_opname' => $request->stock_opname,
                    'item_in' => $request->item_in,
                    'item_out' => $request->item_out,
                ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        \DB::table('products')->where('id', $id)->delete();
        return redirect()->back();
    }
    public function import(Request $request)
    {
        try {
            if ($request->platform == 'shopee') {
                Excel::import(new ShopeeImport, $request->file('fileInput'));
            } else if ($request->platform == 'tiktok') {
                Excel::import(new TiktokImport, $request->file('fileInput'));
            } else if ($request->platform == 'lazada') {
                Excel::import(new LazadaImport, $request->file('fileInput'));
            } else {
                throw new \Exception("Error Processing Request", 403);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
