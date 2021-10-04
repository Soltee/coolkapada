<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Attribute;
use Cart;
use Omnipay\Omnipay;

class CheckoutService
{
	public $authenticatedUser;
	public $shipping;
	public $grand;
	public $data;

	public function __construct(array $validatedData)
	{
		$this->authenticatedUser = auth('customer')->user() ? 
                            			auth('customer')->user()->id : null;
        $this->data              = $validatedData;
        $this->shipping    = (request()->city == 'pokhara') ? 0 : 0;
        $this->grand       = Cart::getTotal() + $this->shipping;
        
	}

	public function confirmAndCreateOrder()
	{
		if($this->data['payment_method'] === 'stripe')
        {
            $this->payByStripe();
        }

        return $this->createOrderItemsAndClearCart($this->createOrder());
	}



	/**
	 * Pay by Stripe
	 * */
	protected function payByStripe()
	{
		try {
            $gateway   = Omnipay::create('Stripe');               
            $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
                        
            $response  = $gateway->purchase([
                'amount'   => $this->grand,
                'currency' => 'usd',
                'token'    => $this->data['token'],
            ])->send();
            
            if (!$response->isSuccessful()) {
                return false;
            }

            return $response;
           
        } catch (CardErrorException $e) {
            
            return $e->getMessage();
        }
	}


	/**
	 * Create New order
	 * */
	protected function createOrder()
	{
		return Order::create([
            'customer_id'      => $this->authenticatedUser,
            'first_name'       => $this->data['first_name'],
            'last_name'        => $this->data['last_name'],
            'email'            => $this->data['email'],
            'phone_number'     => $this->data['phone_number'],
            'city'             => $this->data['city'],
            'street_address'   => $this->data['street_address'],
            'house_number'     => $this->data['house_number'],
            'payment_method'   => $this->data['payment_method'], 
            'sub_total'        => Cart::getSubTotal(),
            'shipping'         => $this->shipping,
            'grand_total'      => $this->grand
        ]);
	}

	/**
	 * 
	 * */
	protected function  createOrderItemsAndClearCart(Order $order)
	{
		foreach(Cart::getContent() as $item){
            $items[] = OrderItem::create([
                'order_id'       => $order->id,
                'customer_id'    => $this->authenticatedUser ,
                'product_id'     => $item->id,
                'image_url'      => $item->attributes->image_url,
                'name'           => $item->name,
                'price'          => $item->price,
                'qty'            => $item->quantity,
                'total'          => $item->price * $item->quantity,
                'attributeId'    => $item->attributes->attributeId,
                'size'           => $item->attributes->size,
                'colorId'        => $item->attributes->colorId,
                'color'          => $item->attributes->color
            ]);

            //Decrement Quantity
            $attribute     = Attribute::findOrfail($item->attributes->attributeId)
                                        ->decrement('quantity', $item->quantity);

            //Update Product Sold Qty
            $product    = Product::findOrfail($item->id);
            $product->update(['sold' => $item->quantity]);

        }

        // Cart::clear();

        return $order;

	}
}

?>
