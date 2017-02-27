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
<title>Belgrade Luxury - @lang('titles.accommodation') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ LaravelLocalization::getLocalizedURL() }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.accommodation') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ route("/") }}/images/services/accommodation.jpg' />   
@stop

@section('stylesheets')

@stop

@section('content')
<!--   START ACCOMMODATION SERVICES DESCRIPTION PANEL SECTION      -->
<section id="accommodation-description-panel" class="service-description-section box panel widescreen background-properties" data-section-name="accommodation-description">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.accommodation')</h2>
                    <p>
                        To help our customers, we have prepared a variety of packages that can meet their different needs and preferences. 
                    </p>
                    <p>
                        Belgrade Luxury packages have derived from our many years of experience encompassing all the necessary services for an unforgettable VIP experience of Belgrade. 
                    </p>
                    <p>
                        Depending on your affinity and intent You can choose one of the packages, but also put together a package tailored to fit your needs, because - The Best Luxury Services Are Customized, Not Standardized.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END ACCOMMODATION SERVICES DESCRIPTION SECTION      -->

<!--   START INQUIRY SECTION      -->
<section id="inquiry-panel" class="service-inquiry-section interstitial ribbon fullwidth space-y" data-section-name="service-inquiry">            
    <img class="gold-decor" src='<?php echo url("/")?>/images/decor.svg'>
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">@lang('common.luxury vip services')</h2>
            <div class='col-xs-6 col-sm-offset-3 col-sm-3 col-md-offset-4 col-md-2'>
            <a id="contact" class="btn" href='{{ LaravelLocalization::localizeURL(route("contact")) }}'> @lang('common.contact us') </a>
            </div>
            <div class='col-xs-6 col-sm-3 col-md-2'>
            <a id="inquiry" class="btn"> @lang('common.inquiry') </a>
            </div>
        </div>    
    </div>   
</section>
<!--   END INQUIRY SECTION      -->

<!--   START ACCOMMODATION SECTION      -->
<section id="accommodation-panel" class="accommodation-section pagination-grid panel fullwidth space-y" data-section-name="accommodation">            
    
    <div class="text-center">	
        <ul  class="nav nav-pills text-uppercase">
            <li class="active col-xs-12 col-sm-4">
                <a href="#apartments" data-toggle="tab">{{ trans_choice('common.apartment', 1) }}</a>
            </li>
            <li class="col-xs-12 col-sm-4">
                <a href="#hotels" data-toggle="tab">{{ trans_choice('common.hotel', 1) }}</a>
            </li>
            <li class="col-xs-12 col-sm-4">
                <a href="#spas" data-toggle="tab">Wellness & Spa</a>
            </li>
        </ul>

        <div class="tab-content clearfix">
            <div class="tab-pane active text-center" id="apartments">               
                @include('accommodation.accommodation', ['accommodation' => $apartments])
            </div>
            <div class="tab-pane" id="hotels">
                @include('accommodation.accommodation', ['accommodation' => $hotels])
            </div>
            <div class="tab-pane" id="spas">
                @include('accommodation.accommodation', ['accommodation' => $spas])
            </div>
        </div>
    </div>  
    
</section>
<!--   END ACCOMMODATION SECTION      -->

<!--   START PACKAGES SECTION      -->
<section id="other-packages-panel" class="other-packages-section interstitial ribbon fullwidth space-y" data-section-name="other-packages">            
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">@lang('common.packages')</h2>
            <p>
                {{ trans_choice('common.other packages', 0) }}
                <a href="{{ route("/") }}" class="">{{ trans_choice('common.other packages', 1) }}</a> 
                {{ trans_choice('common.other packages', 2) }}
                <a class="" href="#">{{ trans_choice('common.other packages', 3) }}</a>
                {{ trans_choice('common.other packages', 4) }}
            </p>
        </div>    
    </div>
    <img class="gold-decor" src='{{ url("/") }}/images/decor.svg'>
    <div class="container-fluid">
        <div class="col-sm-9">
            
        </div>
        <div class="col-sm-offset-0 col-sm-3">
            <div class="">
                DRUGI
            </div>
            <div class="">
                DRUGI
            </div>
            <div class="">
                DRUGI
            </div>
            <div class="">
                DRUGI
            </div>
            <div class="">
                DRUGI
            </div>
        </div>
    </div>
</section>
<!--   END PACKAGES SECTION      -->

<!--   START CUSTOM PACKAGE SECTION      -->
<section id="custom-package-panel" class="custom-package-section interstitial ribbon fullwidth space-y" data-section-name="custom-package">            
    <div class="container text-center">
        <div class="description">
            <h2 class="text-uppercase"> custom @lang('common.package') </h2>
            <p>
                {{ trans_choice('common.custom package', 0) }} <i> {{ trans_choice('common.custom package', 1) }} </i>
            </p>                
        </div>
    </div>
    <img class="gold-decor" src='{{ url("/") }}/images/decor.svg'>
    <div class="container text-center">
        <div class="text-uppercase">
            <div class="col-sm-4">
                {{ trans_choice('common.custom step',1) }}
            </div>
            <div class="col-sm-4">
                {{ trans_choice('common.custom step',2) }}
            </div>
            <div class="col-sm-4">
                {{ trans_choice('common.custom step',3) }}!
            </div>
        </div>
    </div>
</section>
<!--   END CUSTOM PACKAGE SECTION      -->
@stop

@section('scripts')
<script src="{{ url("/") }}/js/reflection.js"></script>

<script>
    var type = 'apartments';
    
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getAccommodation(page, type);
            }
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.nav-pills li a', function (e) {
            var hash = $(this).attr('href').replace('#', '');
            type = hash;
            e.preventDefault();
        });
        $(document).on('click', '.pagination a', function (e) {
            getAccommodation($(this).attr('href').split('page=')[1], type);
            e.preventDefault();
        });
    });
    
    function getAccommodation(page, type) {
        $.ajax({
            url : '?page=' + page + '&type=' + type,
            dataType: 'json'
        }).done(function (data) {
            $('#' + type).html(data);
            location.hash = page;
        }).fail(function () {
            alert(type + ' could not be loaded.');
        });
    }
    
</script>
@stop
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
