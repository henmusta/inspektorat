<section class="content-inner portfolio-wrapper">
    <div class="portfolio-wrapper-inner">
        <div class="section-head text-center">
            <h2 class="title wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;"><span>Galeri</span></h2>
        </div>
        <div class="container-fluid  p-0">

            <div class="swiper portfolio-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-aee30ce2c1d1865f" aria-live="off" style="transform: translate3d(-1860px, 0px, 0px); transition-duration: 1500ms;">
                    {{-- <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="0" role="group" aria-label="1 / 3">
                        <div class="dz-box box-1 style-1">
                            <div class="dz-media">
                                <a href="portfolio-details.html"><img src="assets/images/portfolio/pic1.jpg" alt=""></a>
                            </div>
                            <div class="dz-info">
                                <h3 class="title"><a href="portfolio-details.html">Fitness – Workout Exercises for Fat Loss</a></h3>
                            </div>
                        </div>
                    </div> --}}

                    @foreach ($galery as $key => $val )
                    <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1" role="group" aria-label="2 / 3">
                        <div class="dz-box box-3 style-1">
                            <div class="dz-media">
                                <a href="portfolio-details.html">
                                    @if(isset($val->value))
                                        <img src="{{ asset('storage/galeri-images/'.$val->value) }}" alt="{{ __('Blog Image') }}" width="200" height="143">
                                    @else
                                        <img src="{{ asset('images/noimage.jpg') }}" alt="{{ __('Blog Image') }}" width="200" height="143">
                                    @endif
                                </a>
                            </div>
                            <div class="dz-info">
                                <h3 class="title"><a href="portfolio-details.html">{{$val->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{-- <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="2" role="group" aria-label="3 / 3">
                        <div class="dz-box box-3 style-1">
                            <div class="dz-media">
                                <a href="portfolio-details.html"><img src="assets/images/portfolio/pic3.jpg" alt=""></a>
                            </div>
                            <div class="dz-info">
                                <h3 class="title"><a href="portfolio-details.html">Fitness – Workout Exercises for Fat Loss</a></h3>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="container">

                </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
    </div>
    <svg class="shape-up" width="635" height="107" viewBox="0 0 635 107" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M577 0L-16 107L635 45L577 0Z" fill="var(--primary-dark)"></path>
    </svg>
    <svg class="shape-down" width="673" height="109" viewBox="0 0 673 109" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M682 0L0 56L682 109V0Z" fill="var(--primary)"></path>
    </svg>
</section>
