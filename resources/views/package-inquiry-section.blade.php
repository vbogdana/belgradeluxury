
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->


<!--   START INQUIRY SECTION      -->
<section id="inquiry" class="service-inquiry-section interstitial ribbon fullwidth space-y text-center" data-section-name="inquiry-panel">            
    <img class="img-responsive" src='<?php echo url("/")?>/images/logo/logo-letters.svg' style='max-width: 130px; display: inline-block; margin-bottom: 30px'> 
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase">{{ trans_choice('common.booking', 3) }}</h2>
            <p></p>
            <h4 class="text-uppercase">
                {{ trans_choice('common.booking', 5) }}?
            </h4>            
            <div class='row'>                
                <div class='col-sm-4'>
                </div>
                <div class='col-sm-4'>
                    <img class="img-responsive gold-ornament" style='position: absolute; left:-17px' src='<?php echo url("/")?>\images\ornament.svg'>                                    
                    <a id="inquiry" class="btn" href='{{ route('contact') }}#contact-us'> @lang('common.send an inquiry') </a>                    
                    <img class="img-responsive gold-ornament" style='position: absolute; right:-17px' src='<?php echo url("/")?>\images\ornament.svg'>            
                </div>
                <div class='col-sm-4'>
                </div>
            </div>
        </div>      
    </div>   
</section>
<!--   END INQUIRY SECTION      -->