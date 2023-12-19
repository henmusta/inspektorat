<footer class="site-footer style-1 bg-img-fix" style="background-image: url({{ theme_asset('images/background/footer-bg.png') }});" id="footer">
	<div class="footer-top">
        <div class="container">
			<div class="row">
				<div class="col-xl-4 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
					<div class="widget widget_about">
						<div class="footer-logo logo-dark">
							<a href="{{ url('/') }}"><img style="max-width: 180px;" src="{{ DzHelper::siteLogo() }}" alt="{{ __('Site Logo') }}"></a>
						</div>
						<p>{!! config('Site.biography') !!}</p>
						<h6 class="m-b15">Social Media</h6>
						<div class="dz-social-icon style-1">
							<ul>
                                <li><a target="_blank" class="fab fa-facebook-f" href="{{ config('Social.facebook') }}"></a></li>
                                <li><a target="_blank" class="fab fa-instagram" href="{{ config('Social.instagram') }}"></a></li>
                                <li><a target="_blank" class="fab fa-twitter" href="{{ config('Social.twitter') }}"></a></li>
                                <li><a target="_blank" class="fab fa-linkedin" href="{{ config('Social.linkedin') }}"></a></li>
                            </ul>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
					{!! DzHelper::recentBlogs( array('limit'=>2, 'order'=>'asc', 'orderby'=>'created_at') ); !!}
				</div>
				<div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
					<div class="widget widget_locations">
						<h4 class="footer-title">Kontak</h4>
						<div class="clearfix">
							<p><strong class="text-dark">Lokasi: </strong>{{ config('Site.location') }}</p>
							<p><strong class="text-dark">Phone Number: </strong>{{ config('Site.contact') }}</p>
							<p><strong class="text-dark">Email </strong>{{ config('Site.email') }}</p>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
    <!-- Footer Bottom Part -->
    <div class="container">
    	<div class="footer-bottom">
			<div class="text-center">
                <img style="max-width: 180px;" src="{{ theme_asset('images/background/bdl-pattern.png') }}">
			</div>
        </div>
    </div>
    <img class="svg-shape-1 rotate-360" src="{{ theme_asset('images/pattern/circle-footer-1.svg') }}" alt="{{ __('Footer circle image 1') }}">
    <img class="svg-shape-2 rotate-360" src="{{ theme_asset('images/pattern/circle-footer-1.svg') }}" alt="{{ __('Footer circle image 2') }}">
</footer>

