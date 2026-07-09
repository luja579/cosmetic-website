@extends('layout.master')

@section('content')
  <!-- end header section -->
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Product Grid</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
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
                                            {{-- {{ $product->name }} --}} {{ $product->name }} 
                                        </a>
                                        {{-- <a href="{{ route('bookings.create', $product->id) }}" class="option2">Buy Now</a> --}}
                                    </div>
                                </div>
                                {{-- <div class="img-box" style="display: flex; justify-content: center; align-items: center; min-height: 180px;">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 120px; max-height: 120px; object-fit: contain;">
                                    @else
                                        <img src="{{ asset('assets/images/placeholder.png') }}" alt="No Image" style="max-width: 120px; max-height: 120px; object-fit: contain;">
                                    @endif
                                </div> --}}
                                <div class="img-box">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/placeholder.png') }}" alt="No Image">
                                    @endif
                                    </div>
                                <div class="detail-box " >
                                    <h5 class="font-bold " >{{ $product->name }}</h5><br>
                                    <h6 >Rs.{{ number_format($product->price, 2) }}</h6>
                                    {{-- <p>{!! nl2br(e($product->description)) !!}</p>                                    --}}
                                    {{-- <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap; font-size: 0.95rem;">
                                        <span>Category: <span class="font-semibold">{{ $product->category }}</span></span>
                                        <span>Stock: <span class="font-semibold">{{ $product->stock }}</span></span>
                                    </div> --}}

                                     {{-- <h5 class="font-bold " >Stock</h5>
                                     <h6 >{{ $product->stock }}</h6> --}}
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
      <!-- end product section -->
@endsection