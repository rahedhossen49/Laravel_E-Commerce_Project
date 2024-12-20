@extends('layouts.FrontendLayout')


@section('content')


    <main class="main-wrapper">
        <!-- Start Shop Area  -->
        <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
            <div class="single-product-thumb mb--40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div class="single-product-thumbnail-wrap zoom-gallery">
                                        <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">


                                            @if ($product->galleries)
                                                <div class="thumbnail">

                                                    <a href="{{ asset('storage/' . $product->image) }}" class="popup-zoom">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->slug }}">
                                                    </a>
                                                </div>
                                            @endif

                                            @if ($product->galleries && count($product->galleries) > 0)
                                                @foreach ($product->galleries as $image)
                                                    <div class="thumbnail">
                                                        <a href="{{ asset('storage/' . $image->image) }}"
                                                            class="popup-zoom">
                                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                                alt="Product Images">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="label-block">
                                            <div class="product-badget">
                                                @if ($product->price > 0 && $product->selling_price >= 0)
                                                    @php
                                                        $discount =
                                                            (($product->price - $product->selling_price) /
                                                                $product->price) *
                                                            100;
                                                    @endphp

                                                    @if ($discount > 0)
                                                        {{ ceil($discount) }}% OFF
                                                    @else
                                                        0% OFF
                                                    @endif
                                                @else
                                                    No Discount
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb-3 small-thumb-wrapper">
                                        @if ($product->galleries)
                                            <div class="small-thumb-img">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="thumb image">
                                            </div>
                                        @endif

                                        @if ($product->galleries && count($product->galleries) > 0)
                                            @foreach ($product->galleries as $image)
                                                <div class="small-thumb-img">
                                                    <img src="{{ asset('storage/' . $image->image) }}" alt="thumb image">
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title">{{ $product->title }}</h2>

                                    <span class="price-amount">
                                        @if ($product->selling_price)
                                            {{ $product->selling_price ?? null }}Taka
                                            <strike>{{ $product->price }}Taka</strike>
                                    </span>
                                    @endif
                                    <div class="product-rating">
                                        <div class="star-rating">


                                            {!! str()->repeat('<i class="fas fa-star"></i>', round($product->reviews->avg('rating'))) !!}
                                            {!! str()->repeat('<i class="far fa-star"></i>', 5 - round($product->reviews->avg('rating'))) !!}


                                        </div>
                                        <div class="review-link">
                                            <a href="single-product-3.html#">(<span>{{ count($product->reviews ?? []) }}</span>
                                                customer reviews) {{ round($product->reviews->avg('rating')) }}</a>
                                        </div>
                                    </div>
                                    <ul class="product-meta">
                                        <li class="{{ $product->stock ? '' : 'text-danger' }}"><i
                                                class="fal fa-check"></i>{{ $product->stock ? 'In Stock' : 'Out Of Stock' }}
                                        </li>
                                        <li><i class="fal fa-check"></i>Free delivery available</li>
                                        <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                    </ul>
                                    <p class="description">{{ $product->short_detail }}</p>



                                    <!-- Start Product Action Wrapper  -->
                                    @if (auth('customer')->check())
                                        @if ($product->stock > 0)
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <div class="product-action-wrapper d-flex-center">
                                                    <div class="pro-qty">
                                                        <input type="text" name="qty" value="1">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="product_price"
                                                            value="{{ $product->selling_price ?? $product->price }}">
                                                    </div>
                                                    <ul class="product-action d-flex-center mb--0">
                                                        <li class="add-to-cart">
                                                            <button type="submit" class="axil-btn btn-bg-primary">Add to
                                                                Cart</button>
                                                        </li>
                                                        <li class="wishlist">
                                                            <button type="submit" class="axil-btn wishlist-btn"><i
                                                                    class="far fa-heart"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </form>
                                        @else
                                            <p class="text-danger">Out of stock</p>
                                        @endif
                                    @else
                                        <ul class="product-action d-flex-center mb--0">
                                            <li class="add-to-cart">
                                                <a href="{{ route('customer.login') }}" class="axil-btn btn-bg-primary">Add
                                                    to Cart </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .single-product-thumb -->

            <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
                <div class="container">
                    <ul class="nav tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="active" id="description-tab" data-bs-toggle="tab"
                                href="single-product-3.html#description" role="tab" aria-controls="description"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a id="additional-info-tab" data-bs-toggle="tab" href="single-product-3.html#additional-info"
                                role="tab" aria-controls="additional-info" aria-selected="false">Additional
                                Information</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="reviews-tab" data-bs-toggle="tab" href="single-product-3.html#reviews" role="tab"
                                aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="product-desc-wrapper">
                                {!! $product->long_detail !!}
                            </div>
                            <!-- End .product-desc-wrapper -->
                        </div>
                        <div class="tab-pane fade" id="additional-info" role="tabpanel"
                            aria-labelledby="additional-info-tab">
                            <div class="product-additional-info">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Stand Up</th>
                                                <td>35″L x 24″W x 37-45″H(front to back wheel)</td>
                                            </tr>
                                            <tr>
                                                <th>Folded (w/o wheels) </th>
                                                <td>32.5″L x 18.5″W x 16.5″H</td>
                                            </tr>
                                            <tr>
                                                <th>Folded (w/ wheels) </th>
                                                <td>32.5″L x 24″W x 18.5″H</td>
                                            </tr>
                                            <tr>
                                                <th>Door Pass Through </th>
                                                <td>24</td>
                                            </tr>
                                            <tr>
                                                <th>Frame </th>
                                                <td>Aluminum</td>
                                            </tr>
                                            <tr>
                                                <th>Weight (w/o wheels) </th>
                                                <td>20 LBS</td>
                                            </tr>
                                            <tr>
                                                <th>Weight Capacity </th>
                                                <td>60 LBS</td>
                                            </tr>
                                            <tr>
                                                <th>Width</th>
                                                <td>24″</td>
                                            </tr>
                                            <tr>
                                                <th>Handle height (ground to handle) </th>
                                                <td>37-45″</td>
                                            </tr>
                                            <tr>
                                                <th>Wheels</th>
                                                <td>Aluminum</td>
                                            </tr>
                                            <tr>
                                                <th>Size</th>
                                                <td>S, M, X, XL</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mb--40">
                                        <div class="axil-comment-area pro-desc-commnet-area">
                                            {{-- <h5 class="title">{{ $product->reviews->count() }} Review(s) for this product</h5> --}}

                                            <h5 class="title">{{ $product->reviews->count() }} Review for this product
                                            </h5>
                                            <ul class="comment-list">
                                                <!-- Start Single Comment  -->

                                                @forelse ($product->reviews as $review)
                                                    <li class="comment">
                                                        <div class="comment-body">
                                                            <div class="single-comment">
                                                                <div class="comment-img col-2">
                                                                    <img src="{{ getProfileImage('customer', $review->customer->name) }}"
                                                                        alt="{{ $review->customer->name }}">
                                                                </div>
                                                                <div class="comment-inner">
                                                                    <h6 class="commenter">
                                                                        <a class="hover-flip-item-wrapper"
                                                                            href="single-product-3.html#">
                                                                            <span class="hover-flip-item">
                                                                                <span
                                                                                    data-text="Cameron Williamson">{{ $review->customer->name }}</span>
                                                                            </span>
                                                                        </a>
                                                                        <span class="commenter-rating rating-four-star">
                                                                            {!! str()->repeat('<a href="single-product-3.html#"><i class="fas fa-star"></i></a>', $review->rating) !!}
                                                                            {!! str()->repeat('<a href="single-product-3.html#"><i class="far fa-star"></i></a>', 5 - $review->rating) !!}
                                                                        </span>


                                                                    </h6>
                                                                    <div class="comment-text">
                                                                        <p>
                                                                            {{ $review->details }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <h4>No Reviews Found</h4>
                                                @endforelse

                                                <!-- End Single Comment  -->
                                            </ul>
                                        </div>
                                        <!-- End .axil-commnet-area -->
                                    </div>

                                    <!-- End .col -->
                                    @auth('customer')
                                        <div class="col-lg-6 mb--40">
                                            <!-- Start Comment Respond  -->
                                            <div class="comment-respond pro-des-commend-respond mt--0">
                                                <h5 class="title mb--30">Add a Review</h5>
                                                <p>Your email address will not be published. Required fields are marked *</p>
                                                <div class="rating-wrapper d-flex-center mb--40">
                                                    Your Rating <span class="require">*</span>
                                                    <div class="reating-inner ml--20">
                                                        <a href="single-product-3.html#"><i class="fal fa-star"></i></a>
                                                        <a href="single-product-3.html#"><i class="fal fa-star"></i></a>
                                                        <a href="single-product-3.html#"><i class="fal fa-star"></i></a>
                                                        <a href="single-product-3.html#"><i class="fal fa-star"></i></a>
                                                        <a href="single-product-3.html#"><i class="fal fa-star"></i></a>
                                                    </div>
                                                </div>

                                                <form action="single-product-3.html#">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Other Notes (optional)</label>
                                                                <textarea name="message" placeholder="Your Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>Name <span class="require">*</span></label>
                                                                <input id="name" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>Email <span class="require">*</span> </label>
                                                                <input id="email" type="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-submit">
                                                                <button type="submit" id="submit"
                                                                    class="axil-btn btn-bg-primary w-auto">Submit
                                                                    Comment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End Comment Respond  -->
                                        </div>
                                    @endauth
                                    <!-- End .col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- woocommerce-tabs -->

        </div>
        <!-- End Shop Area  -->

        <!-- Start Recently Viewed Product Area  -->
        {{-- <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Your
                        Recently</span>
                    <h2 class="title">Viewed Items</h2>
                </div>
                <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-01.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">20% OFF</div>
                                </div>

                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">3D™ wireless headset</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$30</span>
                                        <span class="price current-price">$30</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-02.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">40% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">Media remote</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$80</span>
                                        <span class="price current-price">$50</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-03.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">30% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">HD camera</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$60</span>
                                        <span class="price current-price">$45</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-04.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">50% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">PS Remote Control</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$70</span>
                                        <span class="price current-price">$35</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-05.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">25% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">PS Remote Control</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$50</span>
                                        <span class="price current-price">$38</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-03.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">30% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">HD camera</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$60</span>
                                        <span class="price current-price">$45</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-04.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">50% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">PS Remote Control</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$70</span>
                                        <span class="price current-price">$35</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->
                    <div class="slick-single-layout">
                        <div class="axil-product">
                            <div class="thumbnail">
                                <a href="single-product.html">
                                    <img src="assets/images/product/electric/product-05.png" alt="Product Images">
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">25% OFF</div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.html"><i class="far fa-heart"></i></a>
                                        </li>
                                        <li class="select-option"><a href="cart.html">Add to Cart</a></li>
                                        <li class="quickview"><a href="single-product-3.html#" data-bs-toggle="modal"
                                                data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.html">PS5 Remote Control</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price old-price">$50</span>
                                        <span class="price current-price">$38</span>
                                    </div>
                                    <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .slick-single-layout -->

                </div>
            </div>
        </div> --}}
        <!-- End Recently Viewed Product Area  -->

    </main>


@endsection
