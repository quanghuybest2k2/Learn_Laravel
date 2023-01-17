<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('home/slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('home.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('home.new_arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product')
    <!-- end product section -->

    <!--comment and reply system start-->
    <div style="text-align: center; padding-bottom: 30px;">
        <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px;">Comments</h1>
        <form action="{{ url('add_comment') }}" method="post">
            @csrf
            <textarea style="height: 150px; width: 600px;" placeholder="Comment something here..." name="comment"></textarea>
            <br />
            <input type="submit" class="btn btn-primary" value="Comment" />
        </form>
    </div>
    <div style="padding-left: 20%;">
        <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>
        @foreach ($comment as $item)
            <div>
                <b>{{ $item->name }}</b>
                <p>{{ $item->comment }}</p>
                <a style="color: blue;" href="javascript::void(0);" onclick="reply(this)"
                    data-Commentid="{{ $item->id }}">Reply</a>
                @foreach ($reply as $item_reply)
                    {{-- hiển thị reply theo id comment --}}
                    @if ($item_reply->comment_id == $item->id)
                        <div style="padding-left: 3%; padding-bottom: 10px;">
                            <b>{{ $item_reply->name }}</b>
                            <p>{{ $item_reply->reply }}</p>
                            <a style="color: blue;" href="javascript::void(0);" onclick="reply(this)"
                                data-Commentid="{{ $item->id }}">Reply</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
        <!-- Reply Textbox -->
        <div style="display: none;" class="replyDiv">
            <form action="{{ url('add_reply') }}" method="post">
                @csrf
                <input type="text" id="commentId" name="commentId" hidden /> <!-- hidden ẩn id-->
                <textarea style="height: 100px; width: 500px;" name="reply" placeholder="Write something here"></textarea>
                <br />
                <!-- javascript::void(0); // không reload lại trang -->
                <button type="submit"class="btn btn-primary">Reply</button>
                <a href="javascript::void(0);" class="btn btn-danger" onclick="reply_close(this)">Close</a>
            </form>
        </div>
    </div>

    <!--end comment and reply system-->

    <!-- subscribe section -->
    @include('home.subcribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.client')
    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© {{ date('Y') }} All Rights Reserved By <a href="https://html.design/">Free Html
                Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <script>
        /**
         * When the reply button is clicked, the replyDiv is inserted after the reply button and then
         * shown.
         */
        function reply(caller) {
            document.getElementById('commentId').value = $(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }

        function reply_close(caller) {
            $('.replyDiv').hide();
        }
    </script>
    {{-- Làm mới trang và giữ vị trí hiện tại --> ko cho cuộn (Refresh Page and Keep Scroll Position) --}}
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
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
