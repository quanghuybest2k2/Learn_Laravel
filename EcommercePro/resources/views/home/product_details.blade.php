<!DOCTYPE html>
<html>

<head>
    <!--truy cap public folder-->
    {{-- <base href="/public"> --}}
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%;padding:30px;">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }} {{-- hiển thị message thông báo --}}

                </div>
            @endif
            <div class="img-box" style="padding:20px;">
                <img src="/product/{{ $product->image }}" alt="">
            </div>
            <div class="detail-box">
                <h5>{{ $product->title }}</h5>
                @if ($product->discount_price != null)
                    <h6 style="color: red;">Discount price<br />${{ $product->discount_price }}</h6>
                    <h6 style="text-decoration: line-through; color:blue;">Price<br />${{ $product->price }}
                    </h6>
                @else
                    <h6 style="color:blue;">Price<br />${{ $product->price }}</h6>
                @endif
                <h6>Product Category: {{ $product->category }}</h6>
                <h6>Product Details: {{ $product->description }}</h6>
                <h6>Available Quantity: {{ $product->quantity }}</h6>
                {{-- <a href="" class="btn btn-primary">Add to Cart</a> --}}
                <form action="{{ url('add_cart', $product->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="number" name="quantity" value="1" min="1" style="100px;" />
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Add to Cart" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© {{ date('Y') }} All Rights Reserved By <a href="https://html.design/">Free Html
                Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
