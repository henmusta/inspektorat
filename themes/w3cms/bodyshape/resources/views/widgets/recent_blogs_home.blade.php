
         <section class="content-inner-1 overflow-hidden" style="background-image: url(assets/images/background/bg1.png);">
            <div class="container">
                <div class="row justify-content-between align-items-center m-b10">
                    <div class="col-xl-7">
                        <div class="section-head text-center text-md-start">
                            <h2 class="title wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Postingan <span>Terbaru</span></h2>
                        </div>
                    </div>
                    <div class="col-xl-5 text-md-end d-flex align-items-center justify-content-xl-end justify-content-sm-between justify-content-center m-sm-b30 m-b40 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <a href="blog-grid.html" class="btn btn-primary btn-skew d-none d-sm-block"><span>Lihat Semua Postingan</span></a>
                    </div>
                </div>
                <div class="swiper blog-slider-full blog-slider-wrapper swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress swiper-backface-hidden">
                      <div class="swiper-wrapper" id="swiper-wrapper-2c6b83e051055cb101" aria-live="off" style="transform: translate3d(-480px, 0px, 0px); transition-duration: 0ms;">
                        @foreach($blogs as $key => $blog)
                        <div class="swiper-slide wow fadeInUp swiper-slide-visible swiper-slide-active" data-wow-delay="0.6s" role="group" aria-label="1 / 3" style="width: 450px; visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp; margin-right: 30px;" data-swiper-slide-index="0">
                            <div class="dz-card style-1 overlay-shine">
                                <div class="dz-media">
                                    <a href="{!! DzHelper::laraBlogLink($blog->id) !!}">
                                        @if(optional($blog->feature_img)->value)
                                            <img src="{{ asset('storage/blog-images/'.$blog->feature_img->value) }}" alt="{{ __('Blog Image') }}" width="200" height="143">
                                        @else
                                            <img src="{{ asset('images/noimage.jpg') }}" alt="{{ __('Blog Image') }}" width="200" height="143">
                                        @endif
                                    </a>
                                </div>
                                <div class="dz-info">
                                    <div class="dz-meta">
                                        <ul>
                                            <li class="post-date"><a href="javascript:void(0);">{{ Carbon\Carbon::parse($blog->publish_on)->format('F j, Y') }}</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="dz-title"><a href="{!! DzHelper::laraBlogLink($blog->id) !!}">{{$blog->title}}</a></h4>
                                    {!!substr($blog->content, 0, 150)!!}
                                    <hr>
                                    <a href="{!! DzHelper::laraBlogLink($blog->id) !!}" class="btn btn-primary btn-skew"><span>Detail</span></a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </div>
        </section>
