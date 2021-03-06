
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
            <img src="{{ asset('storage/images/'.$vehicle->image) }}" alt="{{ $vehicle['model'].' '.$vehicle['brand'] }}">
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
                    {{ $vehicle['people'].' '.trans_choice('common.person', $vehicle->people) }}
                </p>
                <a href="{{ route("vehicles.vehicle", [ 'vehID' => $vehicle->vehID, 'title' => str_replace(" ", "-", $vehicle->model) ]) }}" class="btn small">    
                    @lang('common.details')
                </a>
                <a href="{{ route("vehicles.inquiry", [ 'vehID' => $vehicle->vehID, 'title' => str_replace(" ", "-", $vehicle->model) ]) }}" class="btn small">
                    @lang('common.quick inquiry')
                </a>
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
{{ $vehicles->links() }}
</div>