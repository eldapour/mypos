<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

    } // end of index

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create',compact('client','categories'));
    } // end of create

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->attach_order($request,$client);

        session()->flash('success',__('site.order_added_success'));

        return redirect()->route('dashboard.orders.index');

    } // end of store

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.edit',compact('client','order','categories'));
    } // end of edit

    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->attach_order($request,$client);

        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    } // end of update

    public function destroy(Client $client, Order $order)
    {

    } // end of destroy


    private function attach_order ($request,$client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id=>$quantity) {

            $product = Product::findORFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];


            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        } // end of each

        $order->update([
            'total_price' => $total_price
        ]);

    } // end of attach Order Function

    private function detach_order($order)
    {
        foreach ($order->products as $product){

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        } // end of foreach

        $order->delete();

    } // end of private detach_order function

} // end of Controller
