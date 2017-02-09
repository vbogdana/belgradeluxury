<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">CMS Dashboard</div>

                <div class="panel-body">
                    <span class="help-block" style="color: darkred">
                        <strong>ERROR: {{ $message }}</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
