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
                        <!-- GALLERY -->         
                        <div class='carousel-holder'>
                            <div class='gallery-main'>
                                <!--
                                @foreach($object->images as $image)
                                <div class=''>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$image->image) }}'>
                                </div>
                                @endforeach                                       
                                -->
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/contact.jpg'></div>
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/contact1.jpg'></div>
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/aboutus.jpg'></div>
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/index.jpg'></div>
                            </div>
                        </div>
                        <div class='carousel-holder'>
                            <div class='gallery-nav'>
                                <!--
                                @foreach($object->images as $image)
                                <div class=''>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$image->image) }}'>
                                </div>
                                @endforeach 
                                -->
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/contact.jpg'></div>
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/contact1.jpg'></div>
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/aboutus.jpg'></div>
                                <div class=''><img class='img-responsive' src='{{ url("") }}/images/backgrounds/index.jpg'></div>
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
                        </div>
                    </div>
                    
                    @if ($type === 'places')
                    <div class="tab-pane info" id="events">
                        events
                    </div>
                    @elseif ($type === 'accommodation')
                    <div class="tab-pane info" id="details">
                        details
                    </div>
                    @elseif ($type === 'vehicles')
                    <div class="tab-pane info" id="details">
                        details
                    </div>
                    @endif
                                       
                    @if ($type !== 'vehicles')
                    <div class="tab-pane info" id="location">
                        location
                    </div>
                    @endif
                 
                    <div class="tab-pane info" id="contact">
                        contact
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
@stop