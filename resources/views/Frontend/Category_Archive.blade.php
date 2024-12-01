@extends('layouts.FrontendLayout')

@section('content')
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <h1 class="title">{{ str(request()->slug ?? 'Others')->headline }} Categories</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="{{ asset('Frontend/assets/images/product/product-45.png') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="axil-shop-top">
                        <div class="row justify-content-end">
                            <div class="col-lg-3">
                                <div class="category-select mt_md--10 mt_sm--10 justify-content-lg-end">
                                    <select class="single-select">
                                        <option>Sort by Latest</option>
                                        <option>Sort by Name</option>
                                        <option>Sort by Price</option>
                                        <option>Sort by Viewed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row--15">
                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="axil-product product-style-one has-color-pick mt--40">
                            <div class="thumbnail">
                                <a href="{{ route('frontend.show', $product->slug) }}">
                                    <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" loading="lazy"
                                        class="main-img sal-animate"
                                        src="{{ $product->image ? asset('storage/' . $product->image) : asset(env('PLACEHOLDER')) }}"
                                        alt="{{ $product->slug }}">
                                    @if ($product->galleries && count($product->galleries) > 0)
                                        <img class="hover-img"
                                            src="{{ $product->galleries && $product->galleries->isNotEmpty() ? asset('storage/' . $product->galleries[0]->image) : asset(env('PLACEHOLDER')) }}"
                                            alt="{{ $product->slug }}">
                                    @endif
                                </a>
                                <div class="label-block label-right">
                                    <div class="product-badget">
                                        {{ ceil((($product->price - $product->selling_price) / $product->price) * 100) }}%
                                        OFF

                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul class="cart-action">

                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="qty" value="1">
                                                    <!-- Quantity set to 1 -->
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="product_price"
                                                        value="{{ $product->selling_price ?? $product->price }}">

                                                    <li class="select-option">
                                                        <button type="submit" class="axil-btn btn-bg-primary">Add to
                                                            Cart</button>
                                                    </li>
                                                </form>
                                            </ul>
                                        </div>

                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a
                                            href="{{ route('frontend.show', $product->id) }}">{{ $product->title }}</a>
                                    </h5>
                                    <div class="product-price-variant">
                                        @if ($product->selling_price)
                                            <span class="price current-price">{{ $product->selling_price }}Taka</span>
                                            <span class="price old-price">{{ $product->price }}Taka</span>
                                        @else
                                            <span class="price old-price">{{ $product->price }}Taka</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="text-center pt-5 pb-5 mt-5 ">

        <a href="#" class="axil-btn btn-bg-lighter btn-load-more">Load more</a>
    </div>

    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i
                            class="fas fa-envelope-open"></i>Newsletter</span>
                    <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="example@gmail.com" type="text">
                        </div>
                        <button type="submit" class="axil-btn mb--15">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
