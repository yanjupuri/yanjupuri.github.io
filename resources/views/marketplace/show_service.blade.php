<div class="container-fluid container-xxl">
    <div class="container-fluid d-flex justify-content-center align-content-stretch">
        <img src="{{ asset('storage/services_images/' . $service->image) }}" alt="Service Image"
            class="custom-img rounded p-1">
    </div>
    <p><strong>Title: </strong> {{ $service->title }}</p>
    <p style="text-align: justify !important;"><strong>Description: </strong> {{ $service->description }}</p>
    <p><strong>Price: </strong> ₱{{ $service->price }}</p>
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
