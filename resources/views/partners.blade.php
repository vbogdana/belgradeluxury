
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.partners') - Belgrade Luxury</title>
<meta name="description" content="{{ Lang::get('common.meta.partners') }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.partners') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ Lang::get('common.meta.partners') }}" />     
<meta property="og:image" content='{{ url("/") }}/images/backgrounds/contact.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--    START PARTNERS INFO SECTION      -->
<section id="partners-information" class="partners-section panel fullwidth space-y" data-section-name="partners-information-panel">
    <div class='container'>
        <div class="description text-center">
            <h1 class="text-uppercase">@lang('titles.partners')</h1>
            <p>
                @lang('common.meta.partners')
            </p>
            <p>
                mail: <a href='mailto:office@belgradeluxury.com'>office@belgradeluxury.com</a>
            </p>
            <p></p>
        </div>       
    </div>
    
    <div class='container-fluid text-center text-uppercase'>
        <?php $i = 0; ?>
        @foreach($partners as $partner)
            @if($i % 6 === 0 && $i !== 0)
            </div>
            @endif
            @if($i % 6 === 0 || $i === 0)
            <div class='row'>
            @endif

            <div class="partner col-xs-4 col-sm-2">
                <img class="img-responsive" src="{{ asset('storage/images/'.$partner->image) }}" alt='{{ $partner->partner }}'>                                                 
                <a href='{{ $partner->link }}' targer='_blank'>                    
                    <h4>{{ $partner->partner }}</h4>
                </a>
            </div>
            <?php $i++; ?>
        @endforeach

        @if(($i === 1) || ((($i - 1) > 0) && ((($i - 1) % 6) !== 0)))
        </div>
        @endif
    </div>
</section>
<!--    END PARTNERS INFO SECTION      -->
@stop

@section('scripts')
@stop
