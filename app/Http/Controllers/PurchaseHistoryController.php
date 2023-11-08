<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use DB;
use Auth;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\OrderDetail;
use App\Models\Upload;
use App\Models\Product;
use App\Models\Measurment;
use App\Utility\CartUtility;
use Cookie;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('orderDetails')->where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(10);
        return view('frontend.user.purchase_history', compact('orders'));
    }
    public function stiching_product_list($id)
    {
        $order_details = OrderDetail::with('product')->where('order_id',decrypt($id))->get();
        return view('frontend.user.stiching_product_list', compact('order_details'));
    }
    public function measurment_payment(Request $request,$id1,$id2)
    {
        if($request->isMethod('post')){
            return redirect('/stiching-product-list/'.encrypt($id2));
        }
        return view('frontend.user.stiching_payment_list',compact('id1','id2'));
    }
    public function measurment_details(Request $request,$id1=null,$id2=null)
    {
       
        if($request->isMethod('post')){
            $data = $request->all();
            $measurment = Measurment::where('order_id',$data['order_id'])->where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->first();
            if(empty($measurment))
            {
                $measurment = new Measurment();
            }
            $measurment->service = $data['service'];
            $measurment->order_id = $data['order_id'];
            $measurment->user_id = $data['user_id'];
            $measurment->name = $data['name'];
            $measurment->product_id = $data['product_id'];
            $measurment->phone = $data['phone'];
            $measurment->height = $data['height'];
            $measurment->bust = $data['bust'];
            $measurment->length = $data['length'];
            $measurment->waist = $data['waist'];
            $measurment->hip = $data['hip'];
            $measurment->sleeves = $data['sleeves'];
            $measurment->neck = $data['neck'];
            $measurment->thigh = $data['thigh'];
            $measurment->knee = $data['knee'];
            $measurment->bottom_length = $data['bottom_length'];
            $measurment->bottom = $data['bottom'];
            $measurment->umberrla = $data['umberrla'];
            $measurment->garment = $data['garment'];
            $measurment->information = $data['information'];
            $measurment->save();
            // return redirect('/measurment-payment');
            $order_id = $data['order_id'];
            $product_id = $data['product_id'];
            return redirect('/measurment-payment/'.$order_id.'/'.$product_id);
            // return view('frontend.user.stiching_payment_list',compact('order_id','product_id'));
        }
        $measurment = Measurment::where('order_id',$id1)->where('product_id',decrypt($id2))->where('user_id',Auth::user()->id)->first();
        return view('frontend.user.measurment_detail',compact('measurment','id1','id2'));
    }
    public function digital_index()
    {
        $orders = DB::table('orders')
            ->orderBy('code', 'desc')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('orders.user_id', Auth::user()->id)
            ->where('products.digital', '1')
            ->where('order_details.payment_status', 'paid')
            ->select('order_details.id')
            ->paginate(15);
        return view('frontend.user.digital_purchase_history', compact('orders'));
    }

    public function purchase_history_details($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        return view('frontend.user.order_details_customer', compact('order'));
    }

    public function download(Request $request)
    {
        $product = Product::findOrFail(decrypt($request->id));
        $downloadable = false;
        foreach (Auth::user()->orders as $key => $order) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                if ($orderDetail->product_id == $product->id && $orderDetail->payment_status == 'paid') {
                    $downloadable = true;
                    break;
                }
            }
        }
        if ($downloadable) {
            $upload = Upload::findOrFail($product->file_name);
            if (env('FILESYSTEM_DRIVER') == "s3") {
                return \Storage::disk('s3')->download($upload->file_name, $upload->file_original_name . "." . $upload->extension);
            } else {
                if (file_exists(base_path('public/' . $upload->file_name))) {
                    return response()->download(base_path('public/' . $upload->file_name));
                }
            }
        } else {
            flash(translate('You cannot download this product.'))->success();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_cancel($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if ($order && ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')) {
            $order->delivery_status = 'cancelled';
            $order->save();

            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->delivery_status = 'cancelled';
                $orderDetail->save();
                product_restock($orderDetail);
            }

            flash(translate('Order has been canceled successfully'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }

        return back();
    }

    public function re_order($id)
    {
        $user_id = Auth::user()->id;

        // if Cart has auction product check
        $carts = Cart::where('user_id', $user_id)->get();
        foreach ($carts as $cartItem) {
            $cart_product = Product::where('id', $cartItem['product_id'])->first();
            if ($cart_product->auction_product == 1) {
                flash(translate('Remove auction product from cart to add products.'))->error();
                return back();
            }
        }

        $order = Order::findOrFail(decrypt($id));
        $success_msgs = [];
        $failed_msgs = [];
        $data['user_id'] = $user_id;
        foreach ($order->orderDetails as $key => $orderDetail) {
            $product = $orderDetail->product;

            if (
                !$product || $product->published == 0 ||
                $product->approved == 0 || ($product->wholesale_product && !addon_is_activated("wholesale"))
            ) {
                array_push($failed_msgs, translate('An item from this order is not available now.'));
                continue;
            }

            if ($product->auction_product == 0) {

                // If product min qty is greater then the ordered qty, then update the order qty 
                $order_qty = $orderDetail->quantity;
                if ($product->digital == 0 && $order_qty < $product->min_qty) {
                    $order_qty = $product->min_qty;
                }

                $cart = Cart::firstOrNew([
                    'variation' => $orderDetail->variation,
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id
                ]);

                $product_stock = $product->stocks->where('variant', $orderDetail->variation)->first();
                if ($product_stock) {
                    $quantity = 1;
                    if ($product->digital != 1) {
                        $quantity = $product_stock->qty;
                        if ($quantity > 0) {
                            if ($cart->exists) {
                                $order_qty = $cart->quantity + $order_qty;
                            }
                            //If order qty is greater then the product stock, set order qty = current product stock qty
                            $quantity = $quantity >= $order_qty ? $order_qty : $quantity;
                        } else {
                            array_push($failed_msgs, $product->getTranslation('name') . ' ' . translate(' is stock out.'));
                            continue;
                        }
                    }
                    $price = CartUtility::get_price($product, $product_stock, $quantity);
                    $tax = CartUtility::tax_calculation($product, $price);

                    CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);
                    array_push($success_msgs, $product->getTranslation('name') . ' ' . translate('added to cart.'));
                } else {
                    array_push($failed_msgs, $product->getTranslation('name') . ' ' . translate('is stock out.'));
                }
            } else {
                array_push($failed_msgs, translate('You can not re order an auction product.'));
                break;
            }
        }

        foreach ($failed_msgs as $msg) {
            flash($msg)->warning();
        }
        foreach ($success_msgs as $msg) {
            flash($msg)->success();
        }

        return redirect()->route('cart');
    }
}
