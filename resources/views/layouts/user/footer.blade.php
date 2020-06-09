        <footer>
            <div class="block top-padd80 bottom-padd80 dark-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="footer-data">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-lg-4">
                                        <div class="widget about_widget wow fadeIn" data-wow-delay="0.1s">
                                            <div class="logo">
                                                <h1 itemprop="headline" style="color:white">
                                                    <a href="/home" title="Home" itemprop="url">
                                                    <!-- <img src="assets/images/logo.png" alt="logo.png" itemprop="image"> -->
                                                    About us
                                                </a>
                                            </h1>
                                            </div>
                                            <p itemprop="description">Our sole aim is to find you the very best Pizza at the very best price whenever you want it. We do all the researching, scouring for the best deals. Just decide and we shall point you in the best direction to save you money. After all, WE ONLY do Pizza.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-lg-4">
                                        <div class="widget information_links wow fadeIn" data-wow-delay="0.2s">
                                            <h4 class="widget-title" itemprop="headline">SITE MAP</h4>
                                            <ul>
                                                <li><a href="/home" title="" itemprop="url">HOME</a></li>
                                                <li><a href="/stores" title="" itemprop="url">STORES</a></li>
                                                <li><a href="/contactus" title="" itemprop="url">CONTACT US</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-lg-4">
                                        <div class="widget get_in_touch wow fadeIn" data-wow-delay="0.4s">
                                            <h4 class="widget-title" itemprop="headline" style="margin-bottom: 10px">CONTACT US</h4>

                                            <div class="social2" >
                                                <a class="brd-rd50" href="javascript:void(0)" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook footericon"></i></a>
                                                <a class="brd-rd50" href="javascript:void(0)" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter footericon"></i></a>
                                                <a class="brd-rd50" href="javascript:void(0)" title="Pinterest" itemprop="url" target="_blank"><i class="fa fa-instagram footericon"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </main><!-- Main Wrapper -->

    <script src="{{ asset('userAssets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('userAssets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('userAssets/js/plugins.js')}}"></script>
    <script src="{{ asset('userAssets/js/main.js')}}"></script>
    <script src="{{ asset('userAssets/js/jquery.lazy.min.js')}}"></script>
      <script src="{{ asset('js/multi-step-modal.js')}}"></script>

     <script type="text/javascript">
         $(document).ready(function(){
            $('.bodyclass').css('opacity',1);
        });
         $(function(){
            $('.lazy').lazy();
         })

     </script>
    @yield('js')
</body>

</html>