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
    .overlay {
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 999;
        top: 0;
        background: rgba(0,0,0,0.6);
    }
    
    .panel-group {
        cursor: move;
        padding: 20px;
        border: 1px solid #d3e0e9;
        box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.1);
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route("cms.portal") }}">Portal ></a>&nbsp;
                    <a id="articles" href="{{ route("cms.portal.articles", ['category' => $article->category->name_en]) }}">{{ $article->category->name_en }} ></a>&nbsp
                    <a href="{{ route("cms.portal.articles.edit.sections", ['category' => $article->category->name_en, 'artID' => $article->artID]) }}">Edit {{ $article->title_en }} ></a>&nbsp;
                    Section {{ $section->position }} >&nbsp;
                    Edit Article Section
                </div>
                
                <div class="panel-body">                    
                    <div class='container-fluid'>
                        <div class="row">
                            
                            {{ Form::open(['route' => ['cms.portal.articles.edit.paragraph', $article->category->name_en, $article->artID], 'method' => 'post', 'class' => 'form-horizontal']) }}

                            <input type="hidden" name="parID" value="{{ $section->parID }}" />
                            
                            <div class='form-group{{ $errors->has('content_en') ? ' has-error' : '' }}'>
                                <label for='content_en' class='col-md-4 control-label'>Content (eng) *</label>

                                <div class='col-md-6'>
                                    <textarea id='content_en' maxlength='510' rows='5' cols='70' class='form-control' name='content_en'>{{ $section->content_en }}</textarea>

                                    @if ($errors->has('content_en'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('content_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class='form-group{{ $errors->has('content_sr') ? ' has-error' : '' }}'>
                                <label for='content_sr' class='col-md-4 control-label'>Content (ser) *</label>

                                <div class='col-md-6'>
                                    <textarea id='content_sr' maxlength='510' rows='5' cols='70' class='form-control' name='content_sr'>{{ $section->content_sr }}</textarea>
                                    
                                    @if ($errors->has('content_sr'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('content_sr') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                    <a class="btn btn-default" style="margin-left: 15px" href="{{ route("cms.portal.articles.edit.sections", ['category' => $article->category->name_en, 'artID' => $article->artID]) }}">Cancel</a>                                                
                                </div>
                            </div>

                            {{ Form::close() }}
                            
                        </div>                            
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
    

</script>
@stop
