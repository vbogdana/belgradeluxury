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
    
    if ($type === 'accommodation') 
    {
        if ($object->spa)
        { 
            $subtype = "spa";
        }
        else if ($object->hotel)
        { 
            $subtype = "hotel";
        }
        else
        { 
            $subtype = "apartment";
        } 
    } else if ($type === 'vehicles')
    { 
        $subtype = 'vehicles';
    } else if ($type === 'places')
    { 
        if ($object->type === 'restaurant') {
            $subtype = 'gastronomy';
        } else {
            $subtype = 'nightlife';
        }
            
    }
?>

@section('title-meta')
<!-- page titles and meta tags -->
@if($type === 'vehicles')
<title>Belgrade Luxury - {{ $object->model.' '.$object->brand }}</title>
@else
<title>Belgrade Luxury - {{ $object['title_'.$locale] }}</title>
@endif

<meta name="description" content="{{ $object['description_'.$locale] }}" />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ LaravelLocalization::getLocalizedURL() }}">
@if($type === 'vehicles')
<meta property="og:title" content="Belgrade Luxury - {{ $object->model.' '.$object->brand }}" />
@else
<meta property="og:title" content="Belgrade Luxury - {{ $object['title_'.$locale] }}" />
@endif
<meta property="og:description" content="{{ $object['description_'.$locale] }}" />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ asset('storage/images/'.$object->image) }}' />   
@stop

@section('stylesheets')
<link href="{{ url("") }}/css/slick.css" rel="stylesheet" type="text/css">
<link href="{{ url("") }}/css/slick-theme.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<!--   START  PANEL SECTION      -->
<section id='information' class='element-information-section fullwidth panel space-y' data-section-name='information-panel'>
    <div class='container'>
        <div class="description text-center" style='margin-bottom: 40px'>
            <h1 class="text-uppercase"> 
                @if($type === 'vehicles')
                {{ $object->model }}
                @else
                {{ $object['title_'.$locale] }}
                @endif 
            </h1>
            <div class="tags">
                @if($type === 'places')
                    @if($object->isRestaurant())
                <a href="{{ route('gastronomy')}}" class="link">@lang('common.gastronomy')</a>
                    @else
                <a href="{{ route('nightlife')}}" class="link">@lang('common.nightlife')</a>
                    @endif
                @else
                <a href="{{ route($type)}}" class="link">@lang('common.'.$type)</a>
                @endif
                
                <span>
                &nbsp;/&nbsp;
                </span>

                @if ($type === 'accommodation')
                    {{ trans_choice('services.'.$subtype, 0) }}
                @else
                    {{ trans_choice('services.'.$object->type, 0) }}
                @endif
                
                <span>
                &nbsp;/&nbsp;
                </span>
                
                @if ($type === 'vehicles')
                    {{ $object->brand }}
                @else
                <a href="{{ $object->geoLat.','.$object->geoLong }}" target="blank" class="fa fa-map-marker"><span>{{ $object->address }}</span></a>
                @endif
                
                <div class="type text-uppercase">
                    <i class="hi-icon contact-{{ $subtype }}"></i>
                    <br/>
                    <!--{{ trans_choice($subtype, 0) }}-->
                </div>
            </div>
        </div>            
    </div>
    
    <div class='container pagination-grid vertical-tabs'>
        <div class='row'>
            
            <div class='col-sm-4'>
                <ul  class="nav nav-pills nav-stacked text-uppercase text-center hi-icon-effect">
                    <li class="photos active" style='width: 100%'>
                        <a href="#photos" data-toggle="tab">
                            <i class="hi-icon fa-picture"></i>
                            <br/>
                            <span>{{ trans_choice('common.photo', 1) }}</span>
                        </a>
                    </li>
                    <li class="" style='width: 100%'>
                        <a href="#description" data-toggle="tab">
                            <i class="hi-icon fa-info"></i>
                            <br/>
                            <span>@lang('common.description')</span>
                        </a>
                    </li>
                    <li class="" style='width: 100%'>
                        @if ($type === 'places')
                        <a href="#events" data-toggle="tab">
                            <i class="hi-icon contact-calendar"></i>
                            <br/>
                            <span>@lang('common.upcoming') @lang('common.events')</span>
                        </a>
                        @elseif (($type === 'accommodation') || ($type === 'vehicles'))
                        <a href="#details" data-toggle="tab">
                            <i class="hi-icon contact-add"></i>
                            <br/>
                            <span>@lang('common.details')</span>
                        </a>
                        @endif                        
                    </li>
                    @if ($type !== 'vehicles')
                    <li class="" style='width: 100%'>
                        <a href="#location" data-toggle="tab">
                            <i class="hi-icon fa-globe"></i>
                            <br/>
                            <span>@lang('common.location')</span>
                        </a>
                    </li>
                    @endif                    
                    <li class="" style='width: 100%'>
                        <a href="#contact" data-toggle="tab">
                            <i class="hi-icon fa-phone"></i>
                            <br/>
                            <span>@lang('common.contact us')</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class='col-sm-8'>
                <div class="tab-content clearfix">
                    
                    <div class="tab-pane active" id="photos">
                        <div class='container-fluid'>
                            <!-- GALLERY -->         
                            <div class='carousel-holder'>
                                <div class='gallery-main'>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$object->image) }}'>
                                    @foreach($object->images as $image)
                                    <div class=''>
                                        <img class='img-responsive' src='{{ asset('storage/images/'.$image->image) }}'>
                                    </div>
                                    @endforeach                                       
                                </div>
                            </div>
                            <div class='carousel-holder'>
                                <div class='gallery-nav'>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$object->image) }}'>
                                    @foreach($object->images as $image)
                                    <div class=''>
                                        <img class='img-responsive' src='{{ asset('storage/images/'.$image->image) }}'>
                                    </div>
                                    @endforeach 
                                </div>
                            </div>     
                        </div>                         
                    </div>
                    
                    <div class="tab-pane info" id="description">
                        <div class="description">
                            <h2>
                                @if($type === 'vehicles')
                                {{ $object->model.', '.$object->brand }}
                                @else
                                {{ $object['title_'.$locale] }}
                                @endif
                            </h2>
                            <p>{{ $object['description_'.$locale] }}</p>
                            @if($type === 'places')
                            <p class='text-capitalize'>@lang('services.hours'): {{ $object->hours }}</p>
                            @endif
                        </div>
                    </div>
                    
                    @if ($type === 'places')
                    <div class="tab-pane info" id="events">
                        <div class='description'>
                            <h2 class='text-uppercase'>
                                program
                            </h2>
                            <div class='event text-uppercase'>
                                @foreach ($events as $event)
                                <div class='col-sm-4'>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$event->image) }}'>
                                </div>
                                <div class='col-sm-8'>
                                    {{ $event->getDate().trans_choice('common.ordinal', $event->getDate()) }}
                                    {{ $event->getMonth() }}
                                    {{ $event->getDay() }}
                                </div>
                                <div>
                                    {{ $event['title_'.$locale] }}
                                </div>                                
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @elseif ($type === 'accommodation')
                    <div class="tab-pane info hi-icon-effect" id="details">
                        <div class='description'>
                            @if ($subtype !== 'hotel')
                            <div class='header'>
                                <i class="hi-icon fa-people"></i>
                                <br/>
                                {{ $object->apartment()->people.' '.trans_choice('common.person',$object->apartment()->people) }}
                            </div> 
                            <div class='container-fluid text-lowercase'>
                                <div class="row">
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->tv }}'>
                                        <i class="hi-icon fa-tv"></i>
                                        <br/>
                                        tv
                                    </div>
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->hottub }}'>
                                        <i class="hi-icon contact-hottub"></i>
                                        <br/>
                                        jacuzzi
                                    </div>
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->wifi }}'>
                                        <i class="hi-icon fa-wifi"></i>
                                        <br/>
                                        wifi
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->bar }}'>
                                        <i class="hi-icon contact-nightlife"></i>
                                        <br/>
                                        bar
                                    </div>
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->airCondition }}'>
                                        <i class="hi-icon fa-air-condition"></i>
                                        <br/>
                                        @lang('services.air condition')
                                    </div>
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->parking }}'>
                                        <i class="hi-icon contact-parking"></i>
                                        <br/>
                                        parking
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4" data-enabled='{{ $object->apartment()->cityCenter }}'>
                                        <i class="hi-icon contact-city-center"></i>
                                        <br/>
                                        @lang('services.city center')
                                    </div>
                                </div>
                            </div>
                            @else
                            @endif
                        </div>
                    </div>
                    @elseif ($type === 'vehicles')
                    <div class="tab-pane info hi-icon-effect" id="details">
                        <div class='description'>
                            <div class='header'>
                                <i class="hi-icon fa-people"></i>
                                <br/>
                                {{ $object->people.' '.trans_choice('common.person',$object->people) }}
                            </div>
                            <div class='container-fluid text-lowercase'>
                                <div class="row">
                                    <div class="col-xs-4" data-enabled='{{ $object->automatic }}'>
                                        <i class="hi-icon contact-automatic"></i>
                                        <br/>
                                        @lang('services.automatic')
                                    </div>
                                    <div class="col-xs-4" data-enabled='{{ $object->chauffeur }}'>
                                        <i class="hi-icon contact-chauffeur"></i>
                                        <br/>
                                        @lang('services.chauffeur')
                                    </div>
                                    <div class="col-xs-4" data-enabled='{{ $object->navigation }}'>
                                        <i class="hi-icon fa-navigation"></i>
                                        <br/>
                                        @lang('services.navigation')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                                       
                    @if ($type !== 'vehicles')
                    <div class="tab-pane info hi-icon-effect" id="location">
                        <div class='description'>
                            <div class='header'>
                                <a href="{{ $object->geoLat.','.$object->geoLong }}" class="link" data-toggle="tab">
                                    <i class="hi-icon fa-map-marker"></i>
                                    <br/>
                                    {{ $object->address }}
                                </a>
                            </div>  
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="">
                                        <div id="map-canvas" class="google-map" data-lat="{{ $object->geoLat }}" data-long="{{ $object->geoLong }}" data-img="{{ url("") }}/images/map-pin.png" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                 
                    <div class="tab-pane info" id="contact">
                        <div class="description">
                            <h2>
                                @lang('common.inquiry')
                            </h2>
                            <p>
                                <a class="link" href="tel:+381644519017" style="margin: 20px 0 0;">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    (+381) 064 4519 017
                                </a>
                            </p>
                        </div>
                        <div class='container-fluid'>
                            <div class='row'>
                                <a id="contact" class="btn" href='{{ route("contact") }}' style="margin: 10px 5px 0; padding: 5px 10px; font-size: 0.9em;"> 
                                    @lang('common.contact us') 
                                </a>                                
                                <a id="inquiry" class="btn" href='{{ route("contact") }}' style="margin: 10px 5px 0; padding: 5px 10px; font-size: 0.9em;"> 
                                    @lang('common.inquiry') 
                                </a>      
                        </div>
                    </div>
                    
                </div>
            </div>                   
        </div>
    </div>    
</section>
<!--   END  PANEL SECTION      -->
@stop

@section('scripts')
<script src='{{ url("") }}/js/slick.min.js'></script>

<script>
    $('.gallery-main').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.gallery-nav',
          adaptiveHeight: true
        });
        $('.gallery-nav').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '.gallery-main',
          dots: true,
          centerMode: true,
          focusOnSelect: true,
          adaptiveHeight: true
        });
    /*
    $('.nav-pills li').on("click", function () {
        $('.nav-pills li.active').removeClass("active");
        $(this).addClass("active");
        $href = $(this).find("a").attr("href");
        $('.tab-pane').each(function() {
            $(this).css("height", "0");
        });
        $($href).css("height", "100");
    });
    */
</script>
<script src="{{ url("/") }}/js/map.js"></script>
<script>
    $(document).ready(function() {
        
    });
</script>
@stop