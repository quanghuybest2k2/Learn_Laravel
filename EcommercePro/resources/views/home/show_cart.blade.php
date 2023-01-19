<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    {{-- js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
        }

        table,
        th,
        td {
            border: 1px solid gray;
        }

        .th_deg {
            font-size: 30px;
            padding: 5px;
            background: skyblue;
        }

        .img_deg {
            width: 200px;
            height: 200px;
        }

        .total_deg {
            font-size: 20px;
            padding: 40px;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->

        <!-- end slider section -->
        <!-- why section -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }} {{-- hiển thị message thông báo --}}

            </div>
        @endif
        <div class="center">
            <table>
                <tr>
                    <th class="th_deg">Product title</th>
                    <th class="th_deg">Product quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>
                </tr>
                @php
                    $total_price = 0;
                @endphp

                @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item->product_title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td><img class="img_deg" src="/product/{{ $item->image }}" alt="" /></td>
                        <td><a class="btn btn-danger" onclick="confirmation(event)"
                                href="{{ url('/remove_cart', $item->id) }}">remove</a></td>
                    </tr>
                    @php
                        $total_price = $total_price + $item->price;
                    @endphp
                @endforeach
            </table>
            <div>
                <h1 class="total_deg">Total Price: ${{ $total_price }}</h1>
            </div>
            <div>
                <h1 style="font-size: 25px;padding-bottom:15px;">Proceed to Order</h1>
                <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
                <a href="{{ url('stripe', $total_price) }}" class="btn btn-danger">Pay Using Card</a>
            </div>
        </div>
        <!-- footer start -->
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© {{ date('Y') }} All Rights Reserved By <a href="https://html.design/">Free Html
                    Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
        </div>
    </div>
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to cancel this product",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>
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
