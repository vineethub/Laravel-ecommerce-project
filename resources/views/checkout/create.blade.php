<!-- Example resources/views/checkout/create.blade.php -->
<h1>Checkout</h1>

<div>
    <h2>Order Summary</h2>
    <ul>
        @foreach($cartItems as $productId => $quantity)
            @if(isset($products[$productId]))
                <li>
                    {{ $products[$productId]->name }} - 
                    Quantity: {{ $quantity }} - 
                    Price: ${{ number_format($products[$productId]->price * $quantity, 2) }}
                </li>
            @endif
        @endforeach
    </ul>
    <hr>
    <strong>Subtotal: ${{ number_format($subtotal, 2) }}</strong>
</div>

<hr>

<div>
    <h2>Shipping Address</h2>
    <!-- For now, this form won't do anything. We'll add the POST logic next. -->
    <form method="POST" action="">
        @csrf
        <div>
            <label for="address_line_1">Address Line 1</label>
            <input type="text" id="address_line_1" name="address_line_1" required>
        </div>
        <div>
            <label for="city">City</label>
            <input type="text" id="city" name="city" required>
        </div>
        <div>
            <label for="state">State</label>
            <input type="text" id="state" name="state" required>
        </div>
        <div>
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" required>
        </div>
        <div>
            <label for="country">Country</label>
            <input type="text" id="country" name="country" required>
        </div>

        <button type="submit">Proceed to Payment</button>
    </form>
</div>
