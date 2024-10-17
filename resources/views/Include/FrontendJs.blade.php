{{-- <!-- JS --!?> --}}
<script src="{{ asset('Frontend/assets/js/vendor/modernizr.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/slick.min.js') }} "></script>
<script src="{{ asset('Frontend/assets/js/vendor/js.cookie.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/jquery-ui.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/sal.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/jquery.magnific-popup.min.js') }} "></script>
<script src="{{ asset('Frontend/assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/counterup.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/vendor/waypoints.min.js') }}"></script>
<script src="{{ asset('Frontend/assets/js/main.js') }}"></script>


<script>
    $('#prod-search').keyup(function() {

        let search = $(this).val()

        $.ajax({
            method: 'get',
            url: '{{ route('frontend.product.search') }}',
            data: {
                search: search
            },
            success: function(res) {

                let results = [];
                res.map(product => {

                    let url = `/product/${product.slug}`
                    let productHTML =
                        ` <div class="axil-product-list">
                    <div class="thumbnail">
                        <a href="${url}">
                            <img style="max-width:150px;" src="{{ asset('storage/${product.image}') }}" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="product-rating">
                            <span class="rating-icon">
                                           {!! str()->repeat('<i class="fas fa-star"></i>', round($product->reviews->avg('rating'))) !!}
                                            {!! str()->repeat('<i class="far fa-star"></i>', 5 - round($product->reviews->avg('rating'))) !!}



                        </span>
                            <span class="rating-number"><span>${product.reviews_count}</span> Reviews</span>
                        </div>
                        <h6 class="product-title"><a href="${url}">${product.title}</a></h6>
                        <div class="product-price-variant">
                            <span class="price current-price">${product.selling_price ?? product.price }</span>
                       ${
                            product.selling_price == null ? '' : `
                            <span class="price old-price">${product.selling_price
                                !=null && product.price }</span>
                        `}
                            </div>
                        <div class="product-cart">
                            <a href="cart.html" class="cart-btn"><i class="fal fa-shopping-cart"></i></a>
                            <a href="wishlist.html" class="cart-btn"><i class="fal fa-heart"></i></a>
                        </div>
                    </div>
                </div>`

                    results.push(productHTML);
                })

                $('.psearch-results').html(results)
            },
            error: function(error) {

            }

        })
    })
</script>
