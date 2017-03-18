
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
{{ $places->links() }}
</div>
@foreach($places as $place)
<div class="col-xs-12 col-md-6 hover-effects hi-icon-effect">
    <figure>
        <div class="img-holder">
            @if ($place->image != null)
            <img src="{{ asset('storage/images/'.$place->image) }}" alt="">
            @else
            No image
            @endif
        </div>
        <figcaption class="text-center">                               
            <div class="header">
                <h2 class="text-uppercase">{{ $place['title_'.$locale] }}</h2>                                                               
            </div>
            <div class="content">
                <a href="{{ $place->geoLat.','.$place->geoLong }}" target="blank" class="hi-icon fa-map-marker"></a>
                <p style='padding: 4px 0 0;'>
                    {{ $place['address'] }}
                </p>
                <a href="{{ route("places.place", ['placeID' => $place->placeID]) }}" class="btn" style="margin: 10px 0 0; padding: 5px 10px; font-size: 0.8em;">    
                    @lang('common.more')
                </a>
            </div>
        </figcaption>
    </figure>
</div>
@endforeach
<div class='col-xs-12'>
{{ $places->links() }}
</div>