<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.host') - Belgrade Luxury</title>
<meta name="description" content="{{ Lang::get('services.host') }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.host') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ Lang::get('services.host') }}" />
<meta property="og:image" content='{{ url("/") }}/images/services/host.jpg' />   
@stop

@section('stylesheets')

@stop

@section('content')
<?php 
    $locale = LaravelLocalization::getCurrentLocale();
    $i = 0;
?>
<!--   START HOST SERVICES DESCRIPTION PANEL SECTION      -->
<section id="host" class="service-description-section box panel widescreen background-properties" data-section-name="host-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.host')</h2>
                    <p>
                        @lang('services.host')
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END HOST SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<!--   START HOSTS SECTION      -->
<section id="all-hosts" class="host-section panel fullwidth space-y-t" data-section-name="all-hosts-panel">            
    
    <div class="container-fluid">
        <div class="row">
        
        @foreach ($hosts as $host)
        <?php 
            if ($i % 2 == 0) {
                $alignment = "text-left";
                $sidePhoto = "";
                $sideContent = "";
                $rotate = "";
            } else {
                $alignment = "text-right";       
                $sidePhoto = "col-sm-push-9";
                $sideContent = "col-sm-pull-3";
                $rotate = "transform: rotateY(180deg); -webkit-transform: rotateY(180deg);";
            }
            $i++;
        ?>
        
            <div class="col-xs-12 col-sm-3 {{ $sidePhoto }} text-center">                 
                @if ($host->image != null)
                <div class="side-photo">
                    <img class="img-responsive img-circle" src="{{ asset('storage/images/'.$host->image) }}">
                @else
                <div>
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 {{ $sideContent }}">
                <div class="side-content {{ $alignment }}">
                    <h4 class="text-uppercase">{{ $host->name }}</h4>
                    <h5 class="text-uppercase">@lang('common.host')</h5>
                    <?php
                        $skills = explode(";", $host['skills_'.$locale]);
                    ?>
                    <ul>
                    @foreach ($skills as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                    </ul>
                    <p>
                        {{ $host['hobbies_'.$locale] }}
                    </p>
                </div>
            </div>
            <div class='col-xs-12'>
                <img class="" src='<?php echo url("/")?>/images/decor-side.svg' style='width: 100%; {{ $rotate }}'>    
            </div>
            <div class="clearfix"></div>           
        @endforeach
        </div>
    </div>     
</section>
<!--   END HOSTS SECTION      -->

@include('inquiry-section')

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@stop