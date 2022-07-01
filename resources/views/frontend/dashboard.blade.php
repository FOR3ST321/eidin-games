@extends('partial.headerFooter')

@section('content')
    {{-- @foreach ($new_game as $item)
        @dump($item)
    @endforeach --}}
    <!-- Start Hero Area -->
    <div class="container" style="margin-top:20px">
        @auth
            <h3>[debug]Hello, {{Auth::user()->name}}</h3>
            <h6>Role: {{Auth::user()->role}}, <?= (Auth::user()->developer != null)? "Also dev": "Member only" ?></h6>
        @endauth
    </div>
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            @foreach ($promo_game as $pgame)
                                <!-- Start Single Slider -->
                                <div class="single-slider" style="background-image: url(frontend/images/hero/slider-bg2.jpg);">
                                    <div class="content" style="padding-right:52%">
                                        <h2><span>Limited Promotion! (only 30 days)</span>
                                            {{ $pgame->game_name }}
                                        </h2>
                                        <div class="pt-3 pb-1">{{ $promotion[$pgame->game_id]->desc }}</div>
                                        <div>{{ $promotion[$pgame->game_id]->url }}</div>
                                        <h3><span>Now Only</span> Rp{{ $pgame->price }}</h3>
                                        <div class="button">
                                            <a href="product-grids.html" class="btn">Buy Now</a>
                                        </div>
                                    </div>
                                    <img src="{{ $promotion[$pgame->game_id]->placeholder }}" alt="" style="width: 48%; height:60%; position:absolute; right:0; top:20%">
                                </div>
                                <!-- End Single Slider -->
                            @endforeach
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner"
                                style="background-image: url({{ $promotion[$new_game[0]->game_id]->placeholder }});">
                                <div class="content" style="background-color: rgba(255, 255, 255, 0.8)">
                                    <h2>
                                        <span>New line required</span>
                                        {{ $new_game[0]->game_name }}
                                    </h2>
                                    <h3>Rp{{ $new_game[0]->price }}</h3>

                                </div>
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>Weekly Sale!</h2>
                                    <p>Saving up to 50% off all online store items this week.</p>
                                    <div class="button">
                                        <a class="btn" href="#onsale">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Banner Area -->
    <section class="banner section pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>NEW GAME</h2>
                        <p>Check those newest games and follow the trends by playing those games. Get it quick!! </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($new_game as $ngame)
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="single-banner position-relative" style="background-image:url('frontend/images/banner/banner-1-bg.jpg'); height:300px">
                            <span class="position-absolute text-light bg-danger pt-2 pb-2 ps-4 pe-4" >New</span>
                            <div class="content" style="padding-right:55%">
                                <h2>{{ $ngame->game_name }}</h2>
                                <p>{{ $ngame->short_desc }}</p>
                                <div class="button">
                                    <a href="" class="btn">View Details</a>
                                </div>
                                <img src="{{ $promotion[$ngame->game_id]->placeholder }}" alt="" class="position-absolute top-0 end-0" style="width: 45%; height:100%;">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Trending Product Area -->
    <section class="trending-product section pt-5" style="margin-top: 12px;" id="onsale">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>ON SALE!!!</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($sale_game as $sgame)
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <div class="single-product">
                            <div class="product-image">
                                <img src="{{ $promotion[$sgame->game_id]->placeholder }}" alt="#">
                                <span class="sale-tag">-50%</span>
                                <div class="button">
                                    <a href="/wishlist" class="btn"><i class="lni lni-heart-filled"></i> Add to Wishlist</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <span class="category">{{ $genres[$sgame->genre_id-1]->genre_name }}</span>
                                <h4 class="title">
                                    <a href="product-grids.html">{{ $sgame->game_name }}</a>
                                </h4>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>{{ $ratings[$sgame->game_id] }} Ratings</span></li>
                                </ul>
                                <div class="price">
                                    <span>Rp{{ $sgame->price }}</span>
                                    <span class="discount-price">Rp{{ $sgame->price*2 }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    {{-- <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info --> --}}
@endsection
