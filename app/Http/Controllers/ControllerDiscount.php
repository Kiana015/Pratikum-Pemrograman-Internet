<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
//List Model Yang digunakan
use App\Product;
use App\Discount;

class ControllerDiscount extends Controller
{
    // public function index(){
    //     return view ('admin.create-discount',compact(['product']));
    // }
    public function discount($id){
        //untuk diskon produk
        $productDiskon = Discount::where('id_product',$id)->first(); 
        $product=Product::find($id); 
        $discount = Discount::all();
        
        if ($productDiskon == null){
            return view ('admin.create-discount',compact(['product', 'discount']));
        }else{
            return view ('admin.edit-discount',compact(['product','productDiskon']));
        }
        
        // return view ('admin.create-discount',compact(['product']));
        // return view ('admin.create-discount',compact(['product', 'discount']));
    }

    public function store(Request $request)
    {
        // $product=Product::find($id); 
        $discounts = new Discount;
        $discounts->id_product = $request->id;
        $discounts->percentage = $request->persentase;
        $discounts->discount_price = $request->harga_diskon;
        $discounts->start = $request->start;
        $discounts->end = $request->end;
        $discounts->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $discounts->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $discounts->save();
        return redirect('/product')->with('berhasil','Anda Berhasil menambahkan data diskon');
  
    }

    public function update(Request $request, $id)
    {
        Discount::where('id_product',$id)->update([
            'percentage'=>$request->persentase,
            'discount_price'=>$request->harga_diskon,
            'start'=>$request->start,
            'end'=>$request->end,
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return redirect('/product')->with('berhasil','Anda Berhasil menambahkan data diskon');
    }

    public function delete(Request $request, $id)
    {
        Discount::where('id_product',$id)->delete();

        return redirect('/product')->with('berhasil','Anda Berhasil menghapus data diskon');
    }


}
