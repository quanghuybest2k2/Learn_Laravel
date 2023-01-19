<section class="product_section layout_padding" id="search">
    <div class="container">
        <div class="heading_container heading_center">
            <div>
                <form action="{{ url('search_product') }}" method="GET">
                    @csrf
                    <input style="width: 500px;" type="text" name="search" placeholder="Search something here..." />
                    <input type="submit" value="Search" />
                </form>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }} {{-- hiển thị message thông báo --}}

            </div>
        @endif
        <div class="row">
            @foreach ($product as $item)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details', $item->id) }}" class="option1">
                                    Product Details
                                </a>
                                <form action="{{ url('add_cart', $item->id) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="number" name="quantity" value="1" min="1"
                                                style="100px;" />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Add to Cart" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product/{{ $item->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>{{ $item->title }}</h5>
                            @if ($item->discount_price != null)
                                <h6 style="color: red;">Discount price<br />${{ $item->discount_price }}</h6>
                                <h6 style="text-decoration: line-through; color:blue;">Price<br />${{ $item->price }}
                                </h6>
                            @else
                                <h6 style="color:blue;">Price<br />${{ $item->price }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <span style="padding-top: 20px;">
            {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
        </span>
    </div>
</section>
