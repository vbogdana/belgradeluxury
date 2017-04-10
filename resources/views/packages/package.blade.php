<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - 
-->
@extends('layouts.master')

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.package', ['package' => $package['title_'.$locale]]) - Belgrade Luxury</title>
<meta name="description" content="{{ $package['description_'.$locale] }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.package', ['package' => $package['title_'.$locale]]) }} - Belgrade Luxury" />
<meta property="og:description" content="{{ $package['description_'.$locale] }}"/>      
<meta property="og:image" content='{{ asset('storage/images/'.$package->cardFront) }}' />   
@stop

@section('stylesheets')

@stop

@section('content')
<!--   START PACKAGE DESCRIPTION PANEL SECTION      -->
<section id="package-description" class="package-description-section box panel widescreen background-properties" data-section-name="package-description-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h1 class="text-uppercase">{{ $package['title_'.$locale] }} @lang('common.package')</h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END PACKAGE DESCRIPTION SECTION      -->

<!--   START INQUIRY SECTION      -->
<section id="inquiry" class="service-inquiry-section interstitial ribbon fullwidth space-y text-center" data-section-name="inquiry-panel">            
    <img class="img-responsive" src='{{ asset('storage/images/'.$package->symbol) }}' style='max-width: 300px; display: inline-block; margin-bottom: 30px'> 
    <div class="container text-center text-uppercase">        
        <h2>
        <a id="inquiry" style="margin-left: 16px;" 
           data-scroll href='#package-details'>
            <i class='fa fa-pulse fa-angle-down' style="color: #E5E4E2"></i>
        </a> 
        </h2>   
    </div>   
</section>
<!--   END INQUIRY SECTION      -->

<!--   START PACKAGE DETAILS PANEL SECTION      -->
<section id="package-details" class="package-details-section box panel widescreen background-properties" data-section-name="package-details-panel">
    <!--<div class="overlay"></div>-->
    <div class="container-fluid">
        <div class="widescreen">
            <div class="box-left">
                <div class="hero-holder">
                    <div class="hero-inner">
                        <div class="description">
                            <h2 class="text-uppercase">About us</h2>
                            <p>
                                If you wish to book Your stay with us please send us an inquiry. As for any requests in addition to those included in the package, we are always at Your disposal!
                            </p>
                            <p>
                                Our phone lines and mail are available 24/7 to answer all Your questions. For any additional information, suggestions and proposals, contact us, we would be delighted to be of assistance.
                            </p>                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="package-details col-xs-12 col-sm-offset-5 col-sm-7 space-y text-center">
            <div class="row hi-icon-effect">
            <?php $i = 0; ?>
            @foreach($package->services as $ps)
                <div class="col-sm-4 text-uppercase">
                    <i class="hi-icon contact-{{ strtolower($ps->service->name_en) }}"></i>
                    <h5>{{ $ps['title_'.$locale] }}</h5>
                    <h6>{{ $ps->service['name_'.$locale] }}</h6>
                        
                </div>               
            <?php $i++; ?>
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</section>
<!--   END PACKAGE DETAILS SECTION      -->

@include('package-inquiry-section')

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
<script src="{{ url("/") }}/js/reflection.js"></script>
@stop
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
