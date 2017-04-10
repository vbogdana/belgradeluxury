<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')
<style>
    .col-sm-4 a {
        height: 100%;
        width: 100%;
    }
    .col-sm-4 a:hover img {
        transform: scale(1.05);
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">CMS Portal</div>

                <div class="panel-body text-center">
                    <div class='container-fluid'>
                        <?php $i = 0; ?>
                        @foreach($categories as $category)
                            @if($i % 3 == 0 && $i != 0)
                            </div>
                            @endif
                            @if($i % 3 == 0)
                            <div class='row'>
                            @endif
                                <div class="col-sm-4">
                                    <a href="{{ route("cms.portal.articles", ['category' => $category->name_en]) }}">
                                         <h4>{{ $category->name_en }}</h4>
                                         <img class="img-responsive" src="{{ url("") }}/images/categories/{{ strtolower($category->name_en) }}.jpg">
                                     </a>
                                 </div>
                            <?php $i++; ?>
                        @endforeach
                    </div>                                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
