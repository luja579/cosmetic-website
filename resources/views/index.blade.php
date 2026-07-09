@extends('layout.master')

@section('content')
<!-- end header section -->
         <!-- slider section -->
         <section class="slider_section ">
            <div class="slider_bg_box">
               <img src="assets/images/slider-bg.jpg" alt="">
            </div>
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                 <h1>
                                    <span>
                                    Beauty Bonanza:
                                    </span>
                                    <br>
                                    Exclusive Offers Sitewide!
                                 </h1>
                                 <p>
                                   Enhance your beauty with GlowUp's cosmetic products. Discover vibrant looks and nourishing skincare today!                                 </p>
                                 <div class="btn-box">
                                    <a href="{{ route('products.index') }}" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- end slider section -->
      </div>
      <!-- why section -->
      <section class="why_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Why Shop With Us
               </h2>
            </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="icon-box">
                        <i class="fa fa-leaf fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="detail-box">
                        <h5>Sustainability</h5>
                        <p>
                            We prioritize eco-friendly practices to ensure a better future for our planet.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="icon-box">
                        <i class="fa fa-star fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="detail-box">
                        <h5>Quality</h5>
                        <p>
                            Our products are designed to exceed expectations with unmatched craftsmanship.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="icon-box">
                        <i class="fa fa-heart fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="detail-box">
                        <h5>Customer Care</h5>
                        <p>
                            Your satisfaction is our priority, and we’re here to support you every step of the way.
                        </p>
                    </div>
                </div>
            </div>
        </div>
         </div>
      </section>
      <!-- end why section -->
      
      <!-- arrival section -->
      <!-- end arrival section -->
      
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
         @if($products->count())
            @foreach($products as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{ route('productShow', $product->id) }}" class="option1">
                              {{ $product->name }} 
                              {{-- Add To Cart --}}
                           </a>
                           {{-- <a href="{{ route('bookings.create', $product->id) }}" class="option2">Buy Now</a> --}}
                        </div>
                     </div>
                     <div class="img-box">
                        @if($product->image)
                           <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                           <img src="{{ asset('assets/images/placeholder.png') }}" alt="No Image">
                        @endif
                     </div>
                     <div class="detail-box">
                        <h5 class="font-bold">{{ $product->name }}</h5>
                        <h6>Rs.{{ number_format($product->price, 2) }}</h6>
                     </div>
                  </div>
               </div>
            @endforeach
            @else
            <div class="col-12">
               <p>No products found for this category.</p>
            </div>
         @endif
      </div>
   </div>
      </section>
@endsection