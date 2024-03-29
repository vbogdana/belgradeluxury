
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
            <img src="{{ asset('storage/images/'.$place->image) }}" alt="{{ $place['title_'.$locale] }}">
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
                <a href="{{ route("places.place", [ 'placeID' => $place->placeID, 'title' => str_replace(" ", "-", $place['title_'.$locale]) ]) }}" class="btn small">    
                    @lang('common.details')
                </a>
                @if ($place->isRestaurant() || !$place->getEvents()->isEmpty())
                <a href="{{ route("places.reservation", [ 'placeID' => $place->placeID, 'title' => str_replace(" ", "-", $place['title_'.$locale]) ]) }}" class="btn small">
                    online @lang('services.reservation')
                </a>
                @endif
            </div>
            <a class="link" href="tel:+381613180874" style="margin: 20px 0 0;">
                <i class="fa fa-phone" aria-hidden="true"></i>
                (+381) 061 3180 874
            </a>
        </figcaption>
    </figure>
</div>
@endforeach
<div class='col-xs-12'>
{{ $places->links() }}
</div>