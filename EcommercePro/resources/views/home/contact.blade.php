<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <!-- inner page section -->
    <section class="inner_page_head">
        <div class="container_fuild">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <h3>Contact us</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end inner page section -->
    <!-- form section -->
    <section class="why_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="full">
                        <form action="index.html">
                            <fieldset>
                                <input type="text" placeholder="Enter your full name" name="name" required />
                                <input type="email" placeholder="Enter your email address" name="email" required />
                                <input type="text" placeholder="Enter subject" name="subject" required />
                                <textarea placeholder="Enter your message" required></textarea>
                                <input type="submit" value="Submit" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end form section -->
    <!-- arrival section -->
    @include('home.new_arrival')
    <!-- end arrival section -->
    <!-- footer section -->
    @include('home.footer')
    <!-- footer section -->
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
