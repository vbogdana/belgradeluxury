
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
                <a href="{{ route("vehicles.vehicle", ['vehID' => $vehicle->vehID]) }}" class="btn" style="margin: 10px 0 0; padding: 5px 10px; font-size: 0.8em;">    
                    @lang('common.more')
                </a>
            </div>
        </figcaption>
    </figure>
</div>
@endforeach
<div class='col-xs-12'>
{{ $vehicles->links() }}
</div>