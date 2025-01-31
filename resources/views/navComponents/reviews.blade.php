<x-app-layout :assets="$assets ?? []">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style>
        /* Custom Css */
        .border-primary {
            border-color: rgb(175, 195, 202) !important;
        }
        .rating {
            font-size: 35px;
        }

        .star {
            cursor: pointer;
        }

        .star:hover,
        .star.active {
            color: gold;
        }

        .review-card {
            width: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .review-card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            cursor: pointer;
        }

        /* CSS for modal */
        .review-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: transparent;
            overflow: auto;
            max-height: 90vh;
        }

        .review-modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            max-width: 90%;
            margin: 0 auto;
        }

        .review-modal-content img {
            max-width: 100%;
            height: auto;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .review-modal-content {
                max-width: 100%;
                width: 300px;
                height: auto;
            }

            .customer-name {
                font-size: 15px !important;
            }
        }

        @media (max-width: 600px) {
            .review-modal-content {
                max-width: 100%;
                width: 300px;
                height: auto;
            }

            .customer-name {
                font-size: 12px !important;
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .customer-name {
            font-size: 18px;
        }

        .star {
            font-size: 48px;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
            overflow-x: hidden;
        }

        .custom-img-size {
            height: 50px;
            width: 50px;
        }

        .cust-rating {
            height: 15px;
            width: 15px;
        }

        @media (max-width:1262px) {
            .p-5 {
                padding: 0 !important;
            }

            .h-50 {
                height: 50px !important;
                width: 200px !important;
            }
        }

        @media (max-width:1440px) {
            .h-50 {
                height: 50px !important;
                width: 200px !important;
            }
        }

        @media (max-width:791px) {
            .p-5 {
                padding: 0 !important;
            }

            .m-5 {
                margin: 0 !important;
            }
        }

        @media (max-width:991px) {
            .custom-alignment {
                justify-content: center;
                text-align: center;
            }
        }

        .admin-reply {
            background-color: #f3f3f3 !important;
        }


        /* NEW STARS CSS RATINGS */

        [data-star] {
            text-align: left;
            font-style: normal;
            display: inline-block;
            position: relative;
            unicode-bidi: bidi-override;
        }

        [data-star]::before {
            display: block;
            content: '★★★★★';
            color: #888;
        }

        [data-star]::after {
            white-space: nowrap;
            position: absolute;
            top: 0;
            left: 0;
            content: '★★★★★';
            width: 0;
            color: gold;
            overflow: hidden;
            height: 100%;
        }

        [data-star^="0.1"]::after {
            width: 2%
        }

        [data-star^="0.2"]::after {
            width: 4%
        }

        [data-star^="0.3"]::after {
            width: 6%
        }

        [data-star^="0.4"]::after {
            width: 8%
        }

        [data-star^="0.5"]::after {
            width: 10%
        }

        [data-star^="0.6"]::after {
            width: 12%
        }

        [data-star^="0.7"]::after {
            width: 14%
        }

        [data-star^="0.8"]::after {
            width: 16%
        }

        [data-star^="0.9"]::after {
            width: 18%
        }

        [data-star^="1"]::after {
            width: 20%
        }

        [data-star^="1.1"]::after {
            width: 22%
        }

        [data-star^="1.2"]::after {
            width: 24%
        }

        [data-star^="1.3"]::after {
            width: 26%
        }

        [data-star^="1.4"]::after {
            width: 28%
        }

        [data-star^="1.5"]::after {
            width: 30%
        }

        [data-star^="1.6"]::after {
            width: 32%
        }

        [data-star^="1.7"]::after {
            width: 34%
        }

        [data-star^="1.8"]::after {
            width: 36%
        }

        [data-star^="1.9"]::after {
            width: 38%
        }

        [data-star^="2"]::after {
            width: 40%
        }

        [data-star^="2.1"]::after {
            width: 42%
        }

        [data-star^="2.2"]::after {
            width: 44%
        }

        [data-star^="2.3"]::after {
            width: 46%
        }

        [data-star^="2.4"]::after {
            width: 48%
        }

        [data-star^="2.5"]::after {
            width: 50%
        }

        [data-star^="2.6"]::after {
            width: 52%
        }

        [data-star^="2.7"]::after {
            width: 54%
        }

        [data-star^="2.8"]::after {
            width: 56%
        }

        [data-star^="2.9"]::after {
            width: 58%
        }

        [data-star^="3"]::after {
            width: 60%
        }

        [data-star^="3.1"]::after {
            width: 62%
        }

        [data-star^="3.2"]::after {
            width: 64%
        }

        [data-star^="3.3"]::after {
            width: 66%
        }

        [data-star^="3.4"]::after {
            width: 68%
        }

        [data-star^="3.5"]::after {
            width: 70%
        }

        [data-star^="3.6"]::after {
            width: 72%
        }

        [data-star^="3.7"]::after {
            width: 74%
        }

        [data-star^="3.8"]::after {
            width: 76%
        }

        [data-star^="3.9"]::after {
            width: 78%
        }

        [data-star^="4"]::after {
            width: 80%
        }

        [data-star^="4.1"]::after {
            width: 82%
        }

        [data-star^="4.2"]::after {
            width: 84%
        }

        [data-star^="4.3"]::after {
            width: 86%
        }

        [data-star^="4.4"]::after {
            width: 88%
        }

        [data-star^="4.5"]::after {
            width: 90%
        }

        [data-star^="4.6"]::after {
            width: 92%
        }

        [data-star^="4.7"]::after {
            width: 94%
        }

        [data-star^="4.8"]::after {
            width: 96%
        }

        [data-star^="4.9"]::after {
            width: 98%
        }

        [data-star^="5"]::after {
            width: 100%
        }
    </style>
    <div class="container-fluid" style="min-height: calc(100vh - 72px);">
        <div class="card m-5">
            <div class="card-body m-5">
                <div class="row custom-alignment">
                    <div class="col-lg-4 col-md-6 col-sm-3">
                        <h3 class="lexend-font-style">Reviews (<span>{{ $counts }}</span>)</h3>
                        {{-- <h4>{{ number_format($averageStars, 1) }}</h4> --}}
                        <i data-star="{{ number_format($averageStars, 1) }}" class="rating"></i>
                        <span>({{ number_format($averageStars, 1) }})</span>

                    </div>

                    <div class="col-sm-2 d-flex mb-5 justify-content-center h-50">
                        <!-- Button trigger modal -->
                        @if (Auth::guest() || Auth::user()->hasRole('user'))
                            <button type="button" class="btn btn-primary" id="add-review">
                                Add a Review
                            </button>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <form action="{{ url()->current() }}" method="GET" id="category-filter-form"
                            onsubmit="showLoading('Loading...')">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <select class="form-select" id="category-filter" name="category">
                                        <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>All
                                            Categories</option>
                                        <optgroup label="Service Categories">
                                            @foreach ($serviceCategories as $serviceCategory)
                                                <option value="{{ $serviceCategory->title }}"
                                                    {{ $selectedCategory === $serviceCategory->title ? 'selected' : '' }}>
                                                    {{ $serviceCategory->title }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Product Categories">
                                            @foreach ($productCategories as $productCategory)
                                                <option value="{{ $productCategory->title }}"
                                                    {{ $selectedCategory === $productCategory->title ? 'selected' : '' }}>
                                                    {{ $productCategory->title }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" id="star-filter" name="stars">
                                        <option value="all" {{ $starsFilter === 'all' ? 'selected' : '' }}>All
                                        </option>
                                        <option value="5" {{ $starsFilter === '5' ? 'selected' : '' }}>
                                            &#9733;&#9733;&#9733;&#9733;&#9733;<span>
                                                ({{ $fiveStarCount ?? 0 }})</span></option>
                                        <option value="4" {{ $starsFilter === '4' ? 'selected' : '' }}>
                                            &#9733;&#9733;&#9733;&#9733;<span> ({{ $fourStarCount ?? 0 }})</span>
                                        </option>
                                        <option value="3" {{ $starsFilter === '3' ? 'selected' : '' }}>
                                            &#9733;&#9733;&#9733;<span> ({{ $threeStarCount ?? 0 }})</span></option>
                                        <option value="2" {{ $starsFilter === '2' ? 'selected' : '' }}>
                                            &#9733;&#9733;<span> ({{ $twoStarCount ?? 0 }})</span></option>
                                        <option value="1" {{ $starsFilter === '1' ? 'selected' : '' }}>
                                            &#9733;<span> ({{ $oneStarCount ?? 0 }})</span></option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                @isset($reviews)
                    @if ($reviews->count() > 0)
                        @foreach ($reviews->chunk(2) as $chunk)
                            <div class="row">
                                @foreach ($chunk as $review)
                                    <div class="col-md-6 ">
                                        <div class="card border border-primary p-5 mt-5">
                                            <div class="card-body">
                                                <div class="row row-cols-3 d-flex justify-content-start">
                                                    <div class="col-2 col-sm-2 custom-size">
                                                        <div class="d-flex justify-content-center">
                                                            @if (!empty($review->user->profile_picture))
                                                                <img src="{{ route('profile_picture', ['filename' => $review->user->profile_picture]) }}"
                                                                    class="custom-img-size rounded">
                                                            @else
                                                                <img src="{{ asset('images/avatars/01.png') }}"
                                                                    class="custom-img-size rounded">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-4 pt-1 custom-size">
                                                        <h6 class="manrope-font-style customer-name">
                                                            {{ $review->user->full_name }}</h6>
                                                        <h6 class="manrope-font-style pt-1 customer-name"
                                                            style="color: rgb(187, 185, 185)">
                                                            Customer<br><span
                                                                class="text-muted customer-name">{{ $review->created_at->diffForHumans() }}</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-6 col-sm-6 text-center">
                                                        <h6 style="color:black; text-transform: capitalize; customer-name">
                                                            {{ $review->rating_type }} - {{ $review->category }}</h6>
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $review->stars)
                                                                <span class="cust-rating"
                                                                    style="color: gold;">&#9733;</span>
                                                            @else
                                                                <span class="cust-rating">&#9733;</span>
                                                            @endif
                                                        @endfor
                                                    </div>

                                                </div>
                                                <p class="pt-3 customer-name">{{ $review->comments ?? '' }}
                                                </p>
                                                @if (!empty($review->image))
                                                    @foreach (explode(',', $review->image) as $image)
                                                        <img src="{{ route('review_image', ['filename' => $image]) }}"
                                                            alt="Customer Review"
                                                            onclick="openReviewModal('{{ asset('storage/review_pictures/' . $image) }}')"
                                                            class="custom-img-size rounded" style="cursor: pointer;">
                                                    @endforeach
                                                @endif

                                                @if (Auth::check() && Auth::user()->id == $review->user_id && $review->created_at->diffInHours(now()) <= 24)
                                                    <div class="text-end mt-3">
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="openEditModal('{{ $review->id }}')">Edit</button>
                                                    </div>
                                                @endif
                                            </div>

                                            @if (!empty($review->replies))
                                                <!-- Display admin reply -->
                                                <div class="mx-2 mb-2 admin-reply customer-name p-3 rounded-1">
                                                    <h6>{{ env('APP_NAME') }} Replied:</h6>
                                                    <p>{{ $review->replies }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <!-- Paginate the reviews -->
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="pagination-container" style="overflow-x: auto;">
                                    {{ $reviews->appends(['category' => $selectedCategory, 'stars' => $starsFilter])->links() }}

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <p>No reviews available.</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <p>No reviews available.</p>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>



    <div class="card m-5">
        <!-- Modal for add review -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Add a Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('reviews.store') }}"
                            onsubmit="showLoading('Adding review...')" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-cols-3">
                                <div class="col-12 col-xxl-4 col-xl-4 col-lg-12 col-md-12 col-sm-12 mt-4">
                                    <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Review for:</h4>
                                </div>
                                <div class="col-6 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-4">
                                    <select name="types" id="types" class="form-select" required>
                                        <option selected value="product">Products</option>
                                        <option value="service">Services</option>
                                    </select>
                                </div>
                                <div class="col-6 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-4">
                                    <select name="product" class="form-select" id="products" required>
                                        @foreach ($productCategories as $product)
                                            <option value="{{ $product->title }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>

                                    <select name="service" class="form-select" id="services" style="display: none;"
                                        required>
                                        @foreach ($serviceCategories as $service)
                                            <option value="{{ $service->title }}">{{ $service->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Your rating:</h4>
                            </div>
                            <div class="rating mt-4" id="rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                                <input type="hidden" id="rating-value" name="rating" value="" required>
                            </div>
                            <div class="mt-4">
                                <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Comments:</h4>
                            </div>
                            <div class="mt-4 pt-2 text-area">
                                <textarea name="comments" id="comments" cols="40" rows="10" placeholder="Optional"></textarea>
                            </div>

                            <div class="mt-4">
                                <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Upload Image(s):</h4>
                            </div>
                            <div class="mt-4">
                                <input type="file" name="images[]" id="images" multiple accept="image/*"
                                    class="form-control" onchange="checkImageCount()">
                                <small class="form-text text-muted">Maximum of two images allowed.</small>
                            </div>
                            @if (Auth::check())
                                <div class="mt-4">
                                    <button type="submit" id="button" class="btn btn-primary">Submit
                                        review</button>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card m-5">
        <!-- Modal for edit review -->
        <div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReviewModalLabel">Edit Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('reviews.updatereview') }}"
                            onsubmit="showLoading('Updating review...')" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" id="id" name="id">
                            <div class="row row-cols-3">
                                <div class="col-12 col-xxl-4 col-xl-4 col-lg-12 col-md-12 col-sm-12 mt-4">
                                    <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Review for:</h4>
                                </div>
                                <div class="col-6 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-4">
                                    <select name="types" id="edit-types" class="form-select" required>
                                        <option selected value="product">Products</option>
                                        <option value="service">Services</option>
                                    </select>
                                </div>
                                <div class="col-6 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-4">
                                    <select name="product" class="form-select" id="edit-products" required>
                                        @foreach ($productCategories as $product)
                                            <option value="{{ $product->title }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>

                                    <select name="service" class="form-select" id="edit-services"
                                        style="display: none;" required>
                                        @foreach ($serviceCategories as $service)
                                            <option value="{{ $service->title }}">{{ $service->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                    <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Your rating:</h4>
                            </div>
                            <div class="rating mt-4" id="rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                                <input type="hidden" id="edit-rating-value" name="edit_rating" value="" required>
                            </div>
                            <div class="mt-4">
                                <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Comments:</h4>
                            </div>
                            <div class="mt-4 pt-2 text-area">
                                <textarea name="comments" id="edit-comments" cols="40" rows="10" placeholder="Optional"></textarea>
                            </div>
                            <div class="mt-4">
                                <h4 class="pt-2 manrope-font-style" style="font-weight: 400">Upload Image(s):</h4>
                            </div>
                            <div class="mt-4">
                                <input type="file" name="images[]" id="edit-images" multiple accept="image/*" class="form-control" onchange="checkEditImageCount()">
                                <small class="form-text text-muted">Maximum of two images allowed.</small>
                            </div>
                            @if (Auth::check())
                                <div class="mt-4">
                                    <button type="submit" id="button" class="btn btn-primary">Update
                                        review</button>
                                </div>
                            @endif                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for image preview review -->
    <div id="review-modal" class="review-modal">
        <div class="review-modal-content">
            <span class="close" onclick="closeReviewModal()">&times;</span>
            <img id="review-modal-image" src="" alt="Modal Image">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-review').click(function() {
                @if (auth()->guest())
                    var loginModal = new bootstrap.Modal($('#loginModal')[0]);
                    loginModal.show();
                @else
                    var reviewModal = new bootstrap.Modal($('#reviewModal')[0]);
                    reviewModal.show();
                @endif
            });
    });
        $(document).ready(function() {
            $(".star").click(function() {
                @if (auth()->guest())
                    var loginModal = new bootstrap.Modal($('#loginModal')[0]);
                    loginModal.show();
                @endif

                var value = parseInt($(this).data("value"));
                highlightStars(value);
                $("#rating-value").val(value);
                console.log($("#rating-value").val());


            });
        });

        $(document).ready(function() {
            $(".star").click(function() {
                @if (auth()->guest())
                    var loginModal = new bootstrap.Modal($('#loginModal')[0]);
                    loginModal.show();
                @endif

                var value = parseInt($(this).data("value"));
                highlightStars(value);
                $("#edit-rating-value").val(value);
                console.log($("#edit-rating-value").val());


            });
        });

        function highlightStars(value) {
            $(".star").each(function() {
                if (parseInt($(this).data("value")) <= value) {
                    $(this).addClass("active");
                } else {
                    $(this).removeClass("active");
                }
            });
        }

        $(document).ready(function() {
            $('#star-rating').select({
                templateResult: formatState
            });
        });

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var stars = '';
            for (var i = 0; i < state.id; i++) {
                stars += '★';
            }
            return stars;
        }


        function openReviewModal(imageSrc) {
            var modal = document.getElementById('review-modal');
            var modalImage = document.getElementById('review-modal-image');
            modal.style.display = 'block';
            modalImage.src = imageSrc;
        }

        function closeReviewModal() {
            var modal = document.getElementById('review-modal');
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('review-modal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.getElementById('types').addEventListener('change', function() {
            var selectedOption = this.value;
            if (selectedOption === 'product') {
                document.getElementById('products').required = true;
                document.getElementById('services').required = false;
            } else if (selectedOption === 'service') {
                document.getElementById('products').required = false;
                document.getElementById('services').required = true;
            } else {
                document.getElementById('products').required = false;
                document.getElementById('services').required = false;
            }
        });

        document.getElementById('types').addEventListener('change', function() {
            var selectedOption = this.value;
            if (selectedOption === 'product') {
                document.getElementById('products').style.display = 'block';
                document.getElementById('services').style.display = 'none';
            } else if (selectedOption === 'service') {
                document.getElementById('products').style.display = 'none';
                document.getElementById('services').style.display = 'block';
            } else {
                document.getElementById('products').style.display = 'none';
                document.getElementById('services').style.display = 'none';
            }
        });

        document.getElementById('edit-types').addEventListener('change', function() {
            var selectedOption = this.value;

            var selectedOption = this.value;
            if (selectedOption === 'product') {
                document.getElementById('edit-products').required = true;
                document.getElementById('edit-services').required = false;

                document.getElementById('edit-products').style.display = 'block';
                document.getElementById('edit-services').style.display = 'none';
            } else if (selectedOption === 'service') {
                document.getElementById('edit-products').required = false;
                document.getElementById('edit-services').required = true;

                document.getElementById('edit-products').style.display = 'none';
                document.getElementById('edit-services').style.display = 'block';
            } else {
                document.getElementById('edit-products').required = false;
                document.getElementById('edit-services').required = false;

                document.getElementById('edit-products').style.display = 'none';
                document.getElementById('edit-services').style.display = 'none';
            }

        });

        function checkImageCount() {
            var input = document.getElementById('images');
            var maxSize = 3 * 1024 * 1024; // 3MB in bytes


            if (input.files.length > 2) {
                Swal.fire({
                    title: 'Maximum of two images allowed.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                input.value = '';
            }

            for (var i = 0; i < input.files.length; i++) {
                if (input.files[i].size > maxSize) {
                    Swal.fire({
                        title: 'File size should not exceed 3MB.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });

                    input.value = '';
                    return; // Exit the function
                }
            }
        }

        function checkEditImageCount() {
            var input = document.getElementById('edit-images');
            var maxSize = 3 * 1024 * 1024; // 3MB in bytes


            if (input.files.length > 2) {
                Swal.fire({
                    title: 'Maximum of two images allowed.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                input.value = '';
            }

            for (var i = 0; i < input.files.length; i++) {
                if (input.files[i].size > maxSize) {
                    Swal.fire({
                        title: 'File size should not exceed 3MB.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });

                    input.value = '';
                    return; // Exit the function
                }
            }
        }

        $(document).ready(function() {
            $('#category-filter').on('change', function() {
                $('#category-filter-form').submit();
            });
        });

        $(document).ready(function() {
            $('#star-filter').on('change', function() {
                $('#category-filter-form').submit();
            });
        });

        function openEditModal(reviewId) {
            $.ajax({
                url: "{{ route('reviews.details') }}",
                type: "GET",
                data: {
                    id: reviewId
                },
                success: function(response) {
                    // Populate common fields
                    $('#editReviewModal #id').val(response.id);
                    $('#editReviewModal #edit-comments').val(response.comments);
                    $('#editReviewModal #edit-rating-value').val(response.stars);
                    highlightStars(parseInt(response.stars));
                    console.log(response.stars);
                    // Populate rating type
                    if (response.rating_type === 'product') {
                        $('#editReviewModal #edit-types').val('product');
                        $('#editReviewModal #edit-products').val(response.category);
                        $('#editReviewModal #edit-products').show();
                        $('#editReviewModal #edit-services').hide();
                    } else {
                        $('#editReviewModal #edit-types').val('service');
                        $('#editReviewModal #edit-services').val(response.category);
                        $('#editReviewModal #edit-services').show();
                        $('#editReviewModal #edit-products').hide();
                    }

                    $('#editReviewModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        window.onload = function(event) {
            Swal.close();
        };

        window.addEventListener('pagehide', function(event) {
            Swal.close();
        });
    </script>
</x-app-layout>
