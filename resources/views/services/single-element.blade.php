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
<title>{{ $object->model.' '.$object->brand }} - Belgrade Luxury</title>
@else
<title>{{ $object['title_'.$locale] }} - Belgrade Luxury</title>
@endif
<!-- Facebook share meta tags -->
<meta name="description" content="{{ $object['description_'.$locale] }}" />
@if($type === 'vehicles')
<meta property="og:title" content="{{ $object->model.' '.$object->brand }} - Belgrade Luxury" />
@else
<meta property="og:title" content="{{ $object['title_'.$locale] }} - Belgrade Luxury" />
@endif
<meta property="og:description" content="{{ $object['description_'.$locale] }}" />       
<meta property="og:image" content='{{ asset('storage/images/'.$object->image) }}' />   
@stop

@section('stylesheets')
<link href="{{ url("") }}/css/slick.css" rel="stylesheet" type="text/css">
<link href="{{ url("") }}/css/slick-theme.css" rel="stylesheet" type="text/css">
@stop

@section('language-toolbar')
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
<li>
    <a rel="alternate" hreflang="{{ $localeCode }}" 
       href="
        <?php 
            $url = LaravelLocalization::getLocalizedURL($localeCode);
            if ($type === 'accommodation' || $type === 'places') {
                $titleStart = strpos($url, "-");
                $url = substr($url, 0, $titleStart + 1).str_replace(' ', '-', $object['title_'.$localeCode]);
            }
            echo $url;
        ?>
       ">
        {{ $properties['native'] }}
    </a>
</li>
@endforeach
@stop

@section('content')
<!--   START  PANEL SECTION      -->
<section id='information' class='element-information-section fullwidth panel space-y' data-section-name='information-panel'>
    <div class='container'>
        <div class="description text-center" style='margin-bottom: 40px'>
            @if($type === 'accommodation' && $subtype === 'hotel')
            <div class='stars'>
            @for($j = 1; $j <= $object->hotel()->stars; $j++)
            <i class="fa fa-star"></i>
            @endfor
            </div>
            @endif
            
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
                        @elseif ($type === 'accommodation' && $subtype === 'hotel')
                        <a href="#rooms" data-toggle="tab">
                            <i class="hi-icon contact-add"></i>
                            <br/>
                            <span>{{ trans_choice('common.room', 1) }}</span>
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
                    @if ($type === 'places')
                    <li class="" style='width: 100%'>
                        <a href="#reservation" data-toggle="tab">
                            <i class="hi-icon fa-phone"></i>
                            <br/>
                            <span>@lang('services.reservation')</span>
                        </a>
                    </li>
                    @else
                    <li class="" style='width: 100%'>
                        <a href="#inquiry" data-toggle="tab">
                            <i class="hi-icon fa-phone"></i>
                            <br/>
                            <span>@lang('common.inquiry')</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            
            <div class='col-sm-8'>
                <div class="tab-content clearfix">
                    
                    <div class="tab-pane active" id="photos">
                        <div class='container-fluid'>
                            <!-- GALLERY -->
                            <?php
                                if($type === 'vehicles') {
                                   $alt = $object->model.' '.$object->brand;
                                } else {
                                   $alt = $object['title_'.$locale];
                                }
                            ?>
                            <div class='carousel-holder'>
                                <div class='gallery-main'>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$object->image) }}' alt="{{ $alt }}">
                                    @foreach($object->images as $image)
                                    <div class=''>
                                        <img class='img-responsive' src='{{ asset('storage/images/'.$image->image) }}' alt="{{ $alt }}">
                                    </div>
                                    @endforeach                                       
                                </div>
                            </div>
                            <div class='carousel-holder'>
                                <div class='gallery-nav'>
                                    <img class='img-responsive' src='{{ asset('storage/images/'.$object->image) }}' alt="{{ $alt }}">
                                    @foreach($object->images as $image)
                                    <div class=''>
                                        <img class='img-responsive' src='{{ asset('storage/images/'.$image->image) }}' alt="{{ $alt }}">
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
                            <p class='text-capitalize'>
                                @lang('services.hours'): <br/>
                                @if ($object['hours_'.$locale] !== null)
                                <?php
                                    $hours = explode(";", $object['hours_'.$locale]);
                                ?>
                                @foreach ($hours as $hour)
                                    {{ $hour }}<br/>
                                @endforeach
                                @endif
                            </p>
                            @endif
                        </div>
                    </div>
                    
                    @if ($type === 'places')
                    <div class="tab-pane info" id="events">
                        <div class='description'>
                            <h2 class='text-uppercase'>
                                program
                            </h2>
                            <p>
                                <a class="link" href="tel:+381600154431" style="margin: 20px 0 0;">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    (+381) 060 0154 431
                                </a>
                                <br/>
                                SMS, WhatsApp & Viber
                            </p>
                            <h5 class='text-uppercase'>
                                @lang('services.free reservations') 
                            </h5>
                            <div class='events text-uppercase container-fluid'>
                                @foreach ($object->getEvents() as $event)
                                <div class="row">
                                    <div class="col-sm-12 title">
                                        @if ($event->article->category !== null)
                                        <i class="fa fa-{{ strtolower($event->article->category->name_en) }}"></i>
                                        @endif
                                        {{ $event->article['title_'.$locale] }}
                                    </div>
                                    <div class='date col-sm-3 col-lg-2'>
                                        <div class="day-of-week">
                                            {{ substr($event->getDay(), 0, 3) }}
                                        </div>
                                        <div class="day">
                                            {{ $event->getDate().trans_choice('common.ordinal', $event->getDate()) }}
                                        </div>
                                        <div class="month">
                                            {{ substr($event->getMonth(), 0, 3) }} 
                                        </div>                                                                       
                                    </div>                                                                       
                                    <div class="col-sm-5 col-lg-7 reservation">
                                        @lang('services.reservations'): {{ $event->reservations }}                                        
                                    </div>
                                    <div class="col-sm-4 col-lg-3">                                        
                                        <a class="btn small" href='{{ route("events.reservation", ['placeID' => $object->placeID, 'title' => str_replace(" ", "-", $object['title_'.$locale]), 'evID' => $event->evID]) }}'>
                                            @lang('services.reserve')
                                            <br />
                                            online
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @elseif ($type === 'accommodation' && ($subtype !== 'hotel'))
                    <div class="tab-pane info hi-icon-effect" id="details">
                        <div class='description'>
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
                        </div>
                    </div>
                    @elseif ($type === 'accommodation' && ($subtype === 'hotel'))
                    <div class="tab-pane info" id="rooms">
                        <div class="description">
                            <h2>
                                @lang('common.room description')
                            </h2>
                            <p>{{ $object->hotel()['rooms_'.$locale] }}</p>
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
                 
                    @if ($type === 'places')
                    <div class="tab-pane info" id="reservation">
                        <div class="description">
                            <h2>
                                @lang('services.reservation')
                            </h2>
                            <p>
                                <a class="link" href="tel:+381600154431" style="margin: 20px 0 0;">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    (+381) 060 0154 431
                                </a>
                                <br/>
                                SMS, WhatsApp & Viber
                            </p>
                            <h5 class='text-uppercase'>
                                @lang('services.free reservations') 
                            </h5>
                        </div>
                        <div class='container-fluid'>
                            <div class='row'>
                                <a id="contact" class="btn small" href='{{ route("contact") }}'> 
                                    @lang('common.contact us') 
                                </a> 
                                @if ($object->isRestaurant() || !$object->getEvents()->isEmpty())
                                <a id="reservation" class="btn small" href='{{ route("places.reservation", [ 'placeID' => $object->placeID, 'title' => str_replace(" ", "-", $object['title_'.$locale]) ]) }}'> 
                                    online @lang('services.reservation') 
                                </a>
                                @endif
                            </div>
                        </div>                    
                    </div>
                    @else
                    <div class="tab-pane info" id="inquiry">
                        <div class="description">
                            <h2>
                                @lang('common.inquiry')
                            </h2>
                            <p>
                                {{ trans_choice('common.booking', 0) }}
                            </p>
                            <p>
                               {{ trans_choice('common.booking', 2) }} 
                            </p>
                            <p>
                                <a class="link" href="tel:+381600154431" style="margin: 20px 0 0;">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    (+381) 060 0154 431
                                </a>
                                <br/>
                                SMS, WhatsApp & Viber
                            </p>
                        </div>
                        <div class='container-fluid'>
                            <div class='row'>
                                <a id="contact" class="btn small" href='{{ route("contact") }}'> 
                                    @lang('common.contact us') 
                                </a>
                                @if($type === 'accommodation')
                                <a id="inquiry" class="btn small" href='{{ route("accommodation.inquiry", [ 'accID' => $object->accID, 'title' => str_replace(" ", "-", $object['title_'.$locale]) ]) }}'> 
                                    @lang('common.inquiry') 
                                </a> 
                                @elseif($type === 'vehicles')
                                <a id="inquiry" class="btn small" href='{{ route("vehicles.inquiry", [ 'vehID' => $object->vehID, 'title' => str_replace(" ", "-", $object->model) ]) }}'> 
                                    @lang('common.inquiry') 
                                </a> 
                                @else
                                <a id="inquiry" class="btn small" href='{{ route("contact") }}#contact-us'> 
                                    @lang('common.inquiry') 
                                </a> 
                                @endif
                            </div>
                        </div>                    
                    </div>
                    @endif
                
                </div>                   
            </div>
        </div> 
    </div>
</section>
<!--   END  PANEL SECTION      -->

<!--    START RECOMMENDED SECTION       -->
<section id="recommended" class="recommended-section fullwidth panel space-y" data-section-name="recommended-panel">
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.recommended')</h2>
            <p></p>
        </div>
    </div>
    <div class="container-fluid pagination-grid">
        <div class='carousel-holder col-xs-offset-1 col-xs-10'>
            <div class='gallery-recommended'>
                
            @foreach($similar as $s)
            <div>
                <div class="hover-effects hi-icon-effect">
                    <figure>
                        <div class="img-holder">
                            @if ($s->image != null)
                            <img src="{{ asset('storage/images/'.$s->image) }}" alt="">
                            @else
                            No image
                            @endif
                        </div>
                        <figcaption class="text-center">                               
                            <div class="header">
                                <h2 class="text-uppercase">
                                    @if($type === 'vehicles')
                                    {{ $s->model }}
                                    <br/>
                                    {{ $s->brand }}
                                    @else
                                    {{ $s['title_'.$locale] }}
                                    @endif  
                                </h2>
                            </div>
                            <div class="content">
                                @if($type === 'vehicles')
                                <a class="hi-icon fa-people"></a>
                                <p style='padding: 4px 0 0;'>
                                    {{ $s['people'].' '.trans_choice('common.person',$s->people) }}
                                </p>
                                @elseif($type === 'places')
                                <a href="{{ $s->geoLat.','.$s->geoLong }}" target="blank" class="hi-icon fa-map-marker"></a>
                                <p style='padding: 4px 0 0;'>
                                    {{ $s['address'] }}
                                </p>
                                @elseif($type === 'accommodation')
                                <div class='icons'>
                                    <a href="{{ $s->geoLat.','.$s->geoLong }}" target="blank" class="hi-icon fa-map-marker"></a>
                                    <p style='padding: 4px 0 0;'>
                                        {{ $s['address'] }}
                                    </p>
                                </div>
                                @if($s->apartment)
                                <div class='icons'>
                                    <a href="" target="blank" class="hi-icon fa-people"></a>
                                    <p style='padding: 4px 0 0;'>
                                        {{ $s->apartment()->people.' '.trans_choice('common.person',$s->apartment()->people) }} 
                                    </p>
                                </div>
                                @endif
                                <br/>
                                @endif

                                @if($type === 'vehicles')
                                <a href="{{ route("vehicles.vehicle", [ 'vehID' => $s->vehID, 'title' => str_replace(" ", "-", $s->model) ]) }}" class="btn small">    
                                    @lang('common.details')
                                </a>
                                @elseif($type === 'places')
                                <a href="{{ route("places.place", [ 'placeID' => $s->placeID, 'title' => str_replace(" ", "-", $s['title_'.$locale]) ]) }}" class="btn small">    
                                    @lang('common.details')
                                </a>
                                @elseif($type === 'accommodation')
                                <a href="{{ route("accommodation.single", [ 'accID' => $s->accID, 'title' => str_replace(" ", "-", $s['title_'.$locale]) ]) }}" class="btn small">
                                    @lang('common.details')
                                </a>
                                @endif

                                @if (($type === 'places') && ($s->isRestaurant() || !$s->getEvents()->isEmpty()))
                                <a href="{{ route("places.reservation", [ 'placeID' => $s->placeID, 'title' => str_replace(" ", "-", $s['title_'.$locale]) ]) }}" class="btn small">
                                    online @lang('services.reservation')
                                </a>
                                @elseif($type === 'accommodation')
                                <a id="inquiry" class="btn small" href='{{ route("accommodation.inquiry", [ 'accID' => $s->accID, 'title' => str_replace(" ", "-", $s['title_'.$locale]) ]) }}'> 
                                    @lang('common.inquiry') 
                                </a> 
                                @elseif($type === 'vehicles')
                                <a id="inquiry" class="btn small" href='{{ route("vehicles.inquiry", [ 'vehID' => $s->vehID, 'title' => str_replace(" ", "-", $s->model) ]) }}'> 
                                    @lang('common.inquiry') 
                                </a> 
                                @elseif ($type !== 'places' && $type !== 'vehicles' && $type !== 'accommodation')
                                <a href="{{ route("contact") }}" class="btn small">
                                    @lang('common.quick inquiry')
                                </a>
                                @endif
                            </div>
                            <a class="link" href="tel:+381600154431" style="margin: 20px 0 0;">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                (+381) 060 0154 431
                            </a>
                        </figcaption>
                    </figure>    
                </div>    
            </div>            
            @endforeach

            </div>
        </div>
    </div>
    
</section>
<!--    END RECOMMENDED SECTION       -->
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
    $('.gallery-recommended').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        adaptiveHeight: true,
        responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        ]
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

@if($type !== 'vehicles')
<script src="{{ url("/") }}/js/map.js"></script>
@endif

@stop