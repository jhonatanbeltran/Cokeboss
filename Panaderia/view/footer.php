<!-- //Footer -->


    <!-- Custom-JavaScript-File-Links -->

    <!-- Default-JavaScript -->
   <script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap-JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- Navigation-JavaScript -->
    <script src="../js/classie.js"></script>
    <script src="../js/main.js"></script>
    <!-- //Navigation-JavaScript -->

    <!-- Slider-JavaScript -->
    <script src="../js/responsiveslides.min.js"></script>
    <script>
        $(function() {
            $("#slider, #slider1").responsiveSlides({
                auto: true,
                nav: true,
                speed: 1500,
                namespace: "callbacks",
                pager: true,
            });
        });
    </script>
    <!-- //Slider-JavaScript -->

    <!-- Owl-Carousel-JavaScript -->
    <script src="../js/owl.carousel.js"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                items: 4,
                lazyLoad: true,
                autoPlay: true,
                pagination: false,
            });
        });
    </script>
    <!-- //Owl-Carousel-JavaScript -->

    <!-- Gallery-Tab-JavaScript -->
    <script src="../js/cbpFWTabs.js"></script>
    <script>
        (function() {
            [].slice.call(document.querySelectorAll('.tabs')).forEach(function(el) {
                new CBPFWTabs(el);
            });
        })();
    </script>
    <!-- //Gallery-Tab-JavaScript -->

    <!-- Swipe-Box-JavaScript -->
    <script src="../js/jquery.swipebox.min.js"></script>
    <script type="text/javascript">
        jQuery(function($) {
            $(".swipebox").swipebox();
        });
    </script>
    <!-- //Swipe-Box-JavaScript -->

    <!-- Stats-Number-Scroller-Animation-JavaScript -->
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/counterup.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>
    <!-- //Stats-Number-Scroller-Animation-JavaScript -->

    <!-- Map-JavaScript -->

    <!-- //Map-JavaScript -->

    <!-- Smooth-Scrolling-JavaScript -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //Smooth-Scrolling-JavaScript -->

    <!-- //Custom-JavaScript-File-Links -->



</body>
<!-- //Body -->



</html>