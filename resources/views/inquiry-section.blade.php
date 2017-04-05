
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->


<!--   START INQUIRY SECTION      -->
<section id="send-inquiry" class="service-inquiry-section interstitial ribbon fullwidth space-y text-center" data-section-name="inquiry-panel">              
    <div class="container">
        <div class="description text-center">            
            <h2 class="text-uppercase"> 
                {{ trans_choice('common.booking', 4) }}?
            </h2>
            <p></p>
            <h5 class="text-uppercase"> 
                {{ trans_choice('common.booking', 3) }}
            </h5>
            <p></p>
            <h4 class="text-uppercase">
                {{ trans_choice('common.booking', 2) }}
            </h4>   
            <p></p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="description">
            <div class='row'>                
                <div class='col-sm-4'>
                    <a id="call" class="btn" href='{{ route("contact") }}#contact-information'> @lang('common.call us') </a>                    
                </div>
                <div class='col-sm-4'>
                    <img class="img-responsive gold-ornament" style='position: absolute; left:0' src='<?php echo url("/")?>\images\square-down.svg'>                
                    <a id="email" class="btn" href='{{ route("contact") }}#contact-information'> @lang('common.send an email') </a>
                    <img class="img-responsive gold-ornament" style='position: absolute; right:0' src='<?php echo url("/")?>\images\square-down.svg'>            
                </div>
                <div class='col-sm-4'>
                    <a id="inquiry" class="btn" href='{{ route("contact") }}#contact-us'> @lang('common.send an inquiry') </a>                    
                </div>
            </div>            
        </div>      
    </div>   
</section>
<!--   END INQUIRY SECTION      -->