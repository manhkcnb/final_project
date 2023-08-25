<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Frontend\CartService;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function buy(Request $request)
    {
        // Retrieve cart item data from request
        $cartItem = [
            "name" => $request->input("name"),
            "photo" => $request->input("photo"),
            "price" => $request->input("price"),
            "quantity" => $request->input("quantity"),
            "size" => $request->input("size"),
            "color" => $request->input("color"),
        ];
        
        $this->cartService->addToCart($cartItem);


        return redirect(url("cart"));
    }

    public function index()
    {
        
        $cart=$this->cartService->list();

        
        return view("frontend.cart", ["cart" => $cart]);
    }

    public function remove($id)
    {
        $cart=$this->cartService->deleteCartItem($id);
        return redirect(url("cart"));
    }

    public function destroy()
    {
        $cart=$this->cartService->clearCart();
        return redirect(url("cart"));
    }

    public function update(Request $request)
    {
        $cart=$this->cartService->list();
        $number = 0;
        foreach ($cart as $product) {
            $key = $product['name'] . $product['color'] . $product['size'];
            $name = "product_" . $key;
            $new_quantity = $request->input($number);
            $this->cartService->updateCartItemQuantity($key, $new_quantity);
            $number++;
        }
        return redirect(url("cart"));
    }

    // Add more methods as needed...
}
