<div class="container-fluid container-xxl">
    <div class="container-fluid d-flex justify-content-center align-content-stretch">
        <img src="{{ asset('storage/product_images/' . $product->image) }}" alt="Product Image"
            class="custom-img rounded p-1">
    </div>
    <p>
        <strong>Condition: </strong>
        @if($product->status === 'new')
            BRAND NEW
        @elseif($product->status === 'like_new')
            USED - LIKE NEW
        @elseif($product->status === 'good')
            USED - GOOD
        @elseif($product->status === 'fair')
            USED - FAIR
        @endif
    </p>
    <p class="mt-2"><strong>Product name: </strong> {{ $product->title }}</p>
    <p style="text-align: justify !important;"><strong>Description: </strong> {{ $product->description }}</p>
    <p><strong>Price: </strong> ₱{{ $product->price }}</p>
    <p><strong>Quantity: </strong>{{ $product->quantity }} left</p>
</div>
<style>
    .custom-img {
        width: 27.5rem;
        height: 18.75rem !important;
    }

    @media (max-width: 576px) {
        .custom-img {
            width: 25.5rem !important;
        }
    }
    @media (max-width: 435px) {
        .custom-img {
            width: 20rem !important;
        }
    }
</style>
