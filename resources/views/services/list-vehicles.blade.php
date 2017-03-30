
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
{{ $vehicles->links() }}
</div>
@foreach($vehicles as $vehicle)
<div class="col-xs-12 col-md-6 hover-effects hi-icon-effect">
    <figure>
        <div class="img-holder">
            @if ($vehicle->image != null)
            <img src="{{ asset('storage/images/'.$vehicle->image) }}" alt="">
            @else
            No image
            @endif
        </div>
        <figcaption class="text-center">                               
            <div class="header">
                <h2 class="text-uppercase">
                    {{ $vehicle['model'] }}
                    <br/>
                    {{ $vehicle['brand'] }}
                </h2>                                                               
            </div>
            <div class="content">
                <a class="hi-icon fa-people"></a>
                <p style='padding: 4px 0 0;'>
                    {{ $vehicle['people'] }}
                </p>
                <a href="{{ route("vehicles.vehicle", ['vehID' => $vehicle->vehID]) }}" class="btn small">    
                    @lang('common.details')
                </a>
                <a href="{{ route("contact") }}" class="btn small">
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
{{ $vehicles->links() }}
</div>