
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>

<div class='col-xs-12'>
{{ $accommodation->links() }}
</div>
@foreach($accommodation as $acc)
<div class="col-xs-12 col-md-6 hover-effects hi-icon-effect">
    <figure>
        <div class="img-holder">
            @if ($acc->image != null)
            <img src="{{ asset('storage/images/'.$acc->image) }}" alt="">
            @else
            No image
            @endif
        </div>
        <figcaption class="text-center">                               
            <div class="header">
                <h2 class="text-uppercase">{{ $acc['title_'.$locale] }}</h2>                                                               
            </div>
            <div class="content">
                <a href="{{ $acc->geoLat.','.$acc->geoLong }}" target="blank" class="hi-icon fa-map-marker"></a>
                <p style='padding: 4px 0 0;'>
                    {{ $acc['address'] }}
                </p>
                @if ($acc->apartment == 1)
                <a href="{{ route("accommodation.single", ['accID' => $acc->accID]) }}" class="btn" style="margin: 10px 5px 0; padding: 5px 10px; font-size: 0.8em;">
                @elseif (($acc->hotel == 1))
                <a href="#" class="btn" style="margin: 10px 5px 0; padding: 5px 10px; font-size: 0.8em;">                
                @elseif (($acc->spa == 1))
                <a href="#" class="btn" style="margin: 10px 5px 0; padding: 5px 10px; font-size: 0.8em;">                
                @endif    
                    @lang('common.details')
                </a>
                <a href="{{ route("contact") }}" class="btn" style="margin: 10px 5px 0; padding: 5px 10px; font-size: 0.8em;">
                    @lang('common.inquiry')
                </a>
            </div>
            <a class="link" href="tel:+381644519017" style="margin: 20px 0 0;">
                <i class="fa fa-phone" aria-hidden="true"></i>
                (+381) 064 4519 017
            </a>
        </figcaption>
    </figure>
</div>
@endforeach
<div class='col-xs-12'>
{{ $accommodation->links() }}
</div>