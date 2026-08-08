<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $detail->page_title }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">{{ $detail->breadcrumb_title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <!--<section id="portfolio-details" class="portfolio-details section" style="padding: 60px 0; background-color: #f7f9fc;"> -->
    <section id="portfolio-details" class="portfolio-details section" style="padding: 60px 0;">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <!-- Image Carousel -->
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper" style="{{ $detail->slider_style }}">
                        <div class="swiper-wrapper align-items-center">
                            <script type="application/json" class="swiper-config">
                                {
                                  "loop": true,
                                  "speed": 1700,
                                  "autoplay": {
                                    "delay": 3000
                                  },
                                  "slidesPerView": "auto",
                                  "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                  }
                                }
                              </script>
                            @foreach ($detail->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset($image->image) }}" alt=""
                                        @if ($image->width) width="{{ $image->width }}" @endif
                                        @if ($image->height) height="{{ $image->height }}" @endif
                                        @if ($detail->image_style) style="{{ $detail->image_style }}" @endif>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Project Info -->
                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200"
                        style="{{ $detail->info_style }}">
                        <h3>Project information</h3>
                        <ul>
                            <li><strong>Project Title</strong>: {{ $detail->project_title }}</li>
                            @if ($detail->category)
                                <li><strong>Category</strong>: {{ $detail->category }}</li>
                            @endif
                            @if ($detail->client)
                                <li><strong>Client</strong>: {{ $detail->client }}</li>
                            @endif
                            @if ($detail->company)
                                <li><strong>Company</strong>: {{ $detail->company }}</li>
                            @endif
                            @if ($detail->college)
                                <li><strong>College</strong>: {{ $detail->college }}</li>
                            @endif
                            @if ($detail->project_date)
                                <li><strong>Project date</strong>: {{ $detail->project_date }}</li>
                            @endif
                            @if ($detail->technologies)
                                <li><strong>Tools & Technologies</strong>: {{ $detail->technologies }}</li>
                            @endif
                            @if ($detail->project_url)
                                <li><strong>Project URL</strong>:</li>
                                <li><a href="{{ $detail->project_url }}"
                                        target="_blank">{{ $detail->project_url_label ?: $detail->project_url }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Project Description -->
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300"
                style="margin-top: 30px; font-size: 1.05rem; line-height: 1.8; padding: 25px; background-color: #fff; border-radius: 10px;">
                @if ($detail->description_title)
                    <h5><strong>{{ $detail->description_title }}:</strong></h5>
                @endif
                {!! $detail->description !!}
            </div>
        </div>
    </section>
    <!-- /Portfolio Details Section -->
</main>
