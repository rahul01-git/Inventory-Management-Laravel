<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\PurchaseMeta;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        $page_title = 'Purchases';
        return view('purchase.index',compact('purchases','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase_no=$this->uniqueNumber();
        $page_title = 'Create Purchase';
        $suppliers = Supplier::where('status',1)->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('purchase.create',compact('purchase_no','page_title','suppliers','units','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'purchase_no' => 'required',
            'supplier_id' => 'required',
            'paid_amount' => 'required',
            'total_amount' => 'required',
            'category_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
        ]);

        $purchase = Purchase::create([
            'purchase_no' => $request->purchase_no,
            'supplier_id' => $request->supplier_id,
            'paid_amount' => $request->paid_amount,
            'total_amount' => $request->total_amount,
            'due_amount' => (int)$request->total_amount-(int)$request->paid_amount,
        ]);

        for($i=0; $i<count($request->category_id); $i++){
            PurchaseMeta::create([
                'purchase_id' => $purchase->id,
                'category_id' => $request->category_id[$i],
                'product_id' => $request->product_id[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'unit_id' => $request->unit_id[$i],
            ]);

        }

        return redirect()-> route('purchase.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        $page_title = 'Purchases View';
        return view('purchase.show',compact('purchase','page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $page_title = 'Purchases Edit';
        return view('purchase.edit',compact('purchase','page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uniqueNumber(){
        $purchase = Purchase::latest()->first();
        if($purchase){
            $name = $purchase->purchase_no;
            $number = explode('_',$name);
            $purchase_no = 'PS_' . str_pad((int)$number[1]+1,6,'0',STR_PAD_LEFT);
        }else{
            $purchase_no = 'PS_000001';
        }
        return $purchase_no;
    }

    public function getProduct($id){
        $products = Product::where('category_id',$id)->get();
        return response()->json($products);
    }
}
