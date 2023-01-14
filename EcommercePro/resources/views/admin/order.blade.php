<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        th {
            padding: 10px;
        }

        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }

        .table_deg {
            border: 2px solid white;
            width: 100%;
            margin: auto;
            padding-top: 50px;
            text-align: center;
        }

        .th_deg {
            background: skyblue;
        }

        .img_size {
            width: 100%;
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title_deg">All Orders</h1>
                <div style="padding-left: 400px; padding-bottom: 30px;">
                    <form action="{{ url('search') }}" method="get">
                        @csrf
                        <input type="text" style="color: black;" name="search" placeholder="Nhập từ khóa..." />
                        <input type="submit" value="Search" class="btn btn-outline-primay" />
                    </form>
                </div>
                <table class="table_deg">
                    <tr class="th_deg">
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        <th>Print PDF</th>
                        <th>Send Email</th>
                    </tr>
                    @forelse ($order as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->product_title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->payment_status }}</td>
                            <td>{{ $item->delivery_status }}</td>
                            <td>
                                <img class="img_size" src="/product/{{ $item->image }}" alt="" />
                            </td>
                            <td>
                                {{-- neu la processing thi hien thi the <a></a> else hien thi the <p></p>(đã xác nhận) --}}
                                @if ($item->delivery_status == 'processing')
                                    <a class="btn btn-primary" href="{{ url('delivered', $item->id) }}"
                                        onclick="return confirm('Đã nhận được hàng?')">Delivered</a>
                                @else
                                    <p style="color: green;">delivered</p>
                                @endif
                            </td>
                            <td><a href="{{ url('print_pdf', $item->id) }}" class="btn btn-secondary">Print PDF</a>
                            </td>
                            <td><a href="{{ url('send_email', $item->id) }}" class="btn btn-info">Send Email</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16">No data found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
