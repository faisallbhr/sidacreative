<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\DataFeed;

class DashboardController extends Controller
{
    public function index()
    {
        $data = new Product();

        // $data['label'] = array_column($products->getDataDashboard('shopee'), 'month');
        // $data['quantity'] = array_column($products->getDataDashboard('shopee'), 'month');

        return view('pages/dashboard/dashboard', compact('data'));
    }
    public function chart(Request $request)
    {
        $data = new Product();
        $months = array_column($data->getDataDashboard($request->platform), 'month');
        $quantity = array_column($data->getDataDashboard($request->platform), 'quantity');
        return (object) [
            'labels' => $months,
            'data' => $quantity
        ];
    }
}
