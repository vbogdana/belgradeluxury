<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - 
-->
@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.accommodation') - Belgrade Luxury</title>
<meta name="description" content="{{ trans_choice('services.accommodation', 0) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.accommodation') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ trans_choice('services.accommodation', 0) }}" />      
<meta property="og:image" content='{{ url("/") }}/images/services/accommodation.jpg' />   
@stop

@section('stylesheets')
<link href="{{ url("") }}/css/slick.css" rel="stylesheet" type="text/css">
<link href="{{ url("") }}/css/slick-theme.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<!--   START ACCOMMODATION SERVICES DESCRIPTION PANEL SECTION      -->
<section id="accommodation" class="service-description-section box panel widescreen background-properties" data-section-name="accommodation-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.accommodation')</h2>
                    <p>
                        {{ trans_choice('services.accommodation', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.accommodation', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END ACCOMMODATION SERVICES DESCRIPTION SECTION      -->

<!--    START TOP PICKS SECTION      -->
<section id="top-picks" class="top-picks-section interstitial fullwidth space-y-t" data-section-name="top-picks-panel">
    <div class="container-fluid"> 
        @include('top-picks-accommodation', ['accommodation' => $toppicks])
    </div>
</section>
<!--    END TOP PICKS SECTION      -->

@include('contact-us-section', ['inquiry' => false])

@include('services.list', ['service' => 'accommodation', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
<script src="{{ url("") }}/js/slick.min.js"></script>
<script>
$(window).on("load", function() {
    $('.top-picks-carousel').slick({
        arrows: false,
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        adaptiveHeight: false,
        responsive: [
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 550,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
});
</script>
@include('services.script', ['types' => $types])
@stop