<!-- /*
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - */
-->

@extends('layouts.master')

@section('content')
<section class='widescreen panel' style='padding: 30vh 0'>
    <div class="container-fluid">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.errors.error') </h2>
            <p>
                <?php
                    $var = trans_choice('common.errors.'.$var, 0);
                    echo trans_choice('common.errors.notfound', 0, ['var' => $var]);
                ?>
            </p>
        </div>    
    </div>
</section>
@stop
