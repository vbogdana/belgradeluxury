
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>

<!--   START PACKAGES SECTION      -->
<section id="packages" class="other-packages-section interstitial ribbon fullwidth space-y" data-section-name="packages-panel">            
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">@lang('common.packages')</h2>
            <p>
                {{ trans_choice('common.other packages', 0) }}
                <a href="{{ route("/") }}" class="">{{ trans_choice('common.other packages', 1) }}</a> 
                {{ trans_choice('common.other packages', 2) }}
                <a class="" href="{{ route("contact") }}">{{ trans_choice('common.other packages', 3) }}</a>
                {{ trans_choice('common.other packages', 4) }}
            </p>
        </div>    
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($packages as $package)
            <div class="col-xs-6 col-sm-4 col-lg-2" style='margin: 20px 0 20px'>
                <a href='{{ route("package", [ 'title' => str_replace(" ", "-", $package['title_'.$locale]) ]) }}'>
                    <img class='img-responsive' src='{{ asset('storage/images/'.$package->symbol) }}' style="margin: auto">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--   END PACKAGES SECTION      -->

<!--   START CUSTOM PACKAGE SECTION      -->
<section id="custom-package" class="custom-package-section interstitial ribbon fullwidth space-y" data-section-name="custom-package-panel">            
    <div class="container text-center">
        <div class="description">
            <h2 class="text-uppercase"> custom @lang('common.package') </h2>
            <p>
                {{ trans_choice('common.custom package', 0) }} <i> {{ trans_choice('common.custom package', 1) }} </i>
            </p>                
        </div>
    </div>
    <img class="gold-decor" src='{{ url("/") }}/images/decor.svg'>
    <div class="container-fluid text-center">
        <div class="text-uppercase">
            <div class="col-sm-4 step">
                <img class="img-responsive" src='{{ url("/") }}\images\step1.svg'>
                <h4>{{ trans_choice('common.custom step',1) }}</h4>
            </div>
            <div class="col-sm-4 step">
                <img class="img-responsive" src='{{ url("/") }}\images\step2.svg'>
                <h4>{{ trans_choice('common.custom step',2) }}</h4>
            </div>
            <div class="col-sm-4 step">
                <img class="img-responsive" src='{{ url("/") }}\images\step3.svg'>
                <h4>{{ trans_choice('common.custom step',3) }}</h4>
            </div>
        </div>
    </div>
</section>
<!--   END CUSTOM PACKAGE SECTION      -->

