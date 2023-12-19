@extends('layout.default')

@section('content')
<!-- Content -->
        <!-- Page Detail -->

        @if (Str::contains($page->slug, 'home'))
            @include('elements.main-banner');
        @else
            <div class="dz-bnr-inr style-1 text-center" style="background-image: url({{ theme_asset('images/banner/bg2.png') }});">
                <div class="container">
                    <div class="dz-bnr-inr-entry">
                        <h1>{{ Str::limit($page->title, 20, ' ...') }}</h1>
                        <!-- Breadcrumb Row -->
                        <nav aria-label="breadcrumb" class="breadcrumb-row">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('HOME') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($page->title, 10, ' ...') }}</li>
                            </ul>
                        </nav>
                        <!-- Breadcrumb Row End -->
                    </div>
                </div>
            </div>
        @endif

        @if ($page)
            @if ($page->visibility == 'PP' && $status == 'locked')
            <div class="container">
                <form method="POST" action="" class="dz-form style-1 my-5 ">
                    @csrf
                    <p>{{ __('This content is password protected. To view it please enter your password below:') }}</p>

                    <div class=" row">
                        <div class="col-md-8 d-flex">
                            <div class="input-area col-sm-8">
                                <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                <div class=" input-line">
                                    <input id="password" type="password" class="form-control" required name="password">
                                </div>
                                @error('password')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="col-sm-4 text-end">
                                <button type="submit" class="btn btn-primary btn-skew">
                                    <span>{{ __('Login') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif

            @if($page->slug == 'home')
                {{-- <div class="container" style="padding:50px"> --}}
                    <section class="content-inner about-wrapper1 about-bx1">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 m-b30">
                                    <div class="dz-media ">
                                        <img src="{{ asset('storage/configuration-images/'.config('Site.icon_logo')) }}" alt="" class="wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                    </div>
                                </div>
                                <div class="col-lg-6 m-b30 about-content">
                                    <div class="section-head">
                                        <h2 class="title wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Inspektorat <span>Tanggamus</span></h2>
                                        <p class="wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                            Inspektorat Daerah Provinsi Tanggamus merupakan Perangkat Daerah Provinsi Tanggamus yang mempunyai tugas pokok melakukan pengawasan terhadap pelaksanaan urusan pemerintahan di Daerah Provinsi, pelaksanaan pembinaan atas penyelenggaraan pemerintahan daerah Kabupaten/Kota dan pelaksanaan urusan pemerintahan di Daerah Kabupaten/Kota.
                                        </p>
                                    </div>

                                    <div class="clearfix wow fadeInUp" data-wow-delay="1.0s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                                        <a href="about-us.html" class="btn btn-skew btn-lg btn-primary shadow-primary"><span>Detail</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>



                    {!! DzHelper::recenthomeBlogs( array('limit'=>6, 'order'=>'asc', 'orderby'=>'created_at') ); !!}

                    {!! DzHelper::homeGalery( array('limit'=>10, 'order'=>'asc', 'orderby'=>'created_at') ); !!}


            @elseif ($status == 'unlock_'.$page->id)
            <div class="container" style="padding:50px">
                {!! html_entity_decode($page->content) !!}
            </div>
                <!-- Child Pages Detail End -->
                @if (optional($page->child_pages)->isNotEmpty())
                <div class="container">
                    <h4>{{ __('Related Pages') }}</h4>
                    <ul class="related-pages p-l m-b30">
                        @forelse($page->child_pages as $child_page)
                        <li>
                            -<a href="{!! DzHelper::laraPageLink($child_page->id) !!}" class="pl-2 ">{{ $child_page->title }}</a>
                            @if ($child_page->child_pages->isNotEmpty())
                                {!! DzHelper::getChildPage($child_page->child_pages) !!}
                            @endif
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                @endif
                <!-- Child Pages Detail End -->
            @endif
        @else
            <div class="col-12">{{ __('No record found.') }}</div>
        @endif
        <!-- Page Detail End -->

<!-- Content end -->
@endsection
