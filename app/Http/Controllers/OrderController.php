<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Crochet;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use Excel;
use App\Exports\OrdersExport;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchDate = $request->search;
        if ($searchDate) {
            $formattedSearchDate = Carbon::parse($searchDate)->format('Y-m-d');
            $order = Order::whereDate('created_at', '=', $formattedSearchDate)->simplePaginate(5);
        } else {
            $order = Order::simplePaginate(5);
        }
       
        return view('order.orderdata', compact('order'));
        
    }

    public function indexAdmin(Request $request)
    {
        $searchDate = $request->search;
        if ($searchDate) {
            $formattedSearchDate = Carbon::parse($searchDate)->format('Y-m-d');
            $order = Order::whereDate('created_at', '=', $formattedSearchDate)->simplePaginate(5);
        } else {
            $order = Order::simplePaginate(5);
        }

        return view('order.dataRecap', compact('order'));
    }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'purchase-recap.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $crochets = Crochet::all();
        return view('order.create', compact('crochets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'crochets' => 'required',
        ]);

        $countDuplicate = array_count_values($request->crochets);
        $arrayFormat = [];
        foreach ($countDuplicate as $key => $value) {
            $detailCrochet = Crochet::find($key);

            if ($detailCrochet['stock'] < $value) {
                $msg = 'Cannot purchase items' . $detailCrochet['name'] . 'remaining stock : ' . $detailCrochet['stock'];
                return redirect()->back()->withInput()->with('failed', $msg);
            }

            $crochetFormat = [
                "id" => $key,
                "name_crochet" => $detailCrochet['name'],
                "price" => $detailCrochet['price'],
                "qyt" => $value,
                "sub_price" => $detailCrochet['price'] * $value,
            ];
            array_push($arrayFormat, $crochetFormat);
        }

        $totalPrice = 0;
        foreach ($arrayFormat as $key => $value) {
            $totalPrice += $value['sub_price'];
        }

        $PPN = $totalPrice + ($totalPrice * 0.1);

        $addOrder = Order::create([
            'user_id' => Auth::user()->id,
            'crochets' => $arrayFormat,
            'name_customer' => $request->name_customer,
            'total' => $PPN,
        ]);

        if ($addOrder) {
            foreach ($arrayFormat as $key => $value) {
                $before = Crochet::find($value['id']);
                Crochet::where('id', $value['id'])->update([
                    'stock' => ($before['stock']) - $value['qyt']
                ]);
            }
            return redirect()->route('orders.show', $addOrder['id']);
        } else {
            return redirect()->back()->with('failed', 'Failed to make a purchase');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('order.print', compact('order'));
    }

    public function downloadPDF($id)
    {
        $order = Order::find($id)->toArray();
        view()->share('order', $order);
        $pdf = PDF::loadView('order.downloadpdf', $order);
        return $pdf->download('receipt.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
