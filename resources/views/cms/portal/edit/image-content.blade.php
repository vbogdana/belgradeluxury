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
                            
                            {{ Form::open(['route' => ['cms.portal.articles.edit.image', $article->category->name_en, $article->artID], 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"]) }}

                            <input type="hidden" name="imgID" value="{{ $section->imgID }}" />
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">Current Image</label>

                                <div class="col-md-6">
                                    @if ($section->image != null)
                                    <img class="img-responsive" src="{{ asset('storage/images/'.$section->image) }}">
                                    @else
                                    No image
                                    @endif
                                </div>
                            </div>

                            <div class='form-group{{ $errors->has('image') ? ' has-error' : '' }}'>
                                <label for='image' class='col-md-4 control-label'>New Image *</label>

                                <div class='col-md-6'>
                                    <input type='file' id='image' class='form-control' name='image'>
                                    
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class='form-group{{ $errors->has('caption_en') ? ' has-error' : '' }}'>
                                <label for='caption_en' class='col-md-4 control-label'>Caption (eng)</label>

                                <div class='col-md-6'>
                                    <input type='text' id='caption_en' maxlength='255' class='form-control' name='caption_en' value="{{ $section->caption_en }}">
                                    
                                    @if ($errors->has('caption_en'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('caption_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class='form-group{{ $errors->has('caption_sr') ? ' has-error' : '' }}'>
                                <label for='caption_sr' class='col-md-4 control-label'>Caption (ser)</label>

                                <div class='col-md-6'>
                                    <input type='text' id='caption_sr' maxlength='255' class='form-control' name='caption_sr' value="{{ $section->caption_sr }}">
                                    
                                    @if ($errors->has('caption_sr'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('caption_sr') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class='form-group{{ $errors->has('credit') ? ' has-error' : '' }}'>
                                <label for='credit' class='col-md-4 control-label'>Credit</label>

                                <div class='col-md-6'>
                                    <input type='text' id='credit' maxlength='255' class='form-control' name='credit' value="{{ $section->credit }}">
                                    
                                    @if ($errors->has('credit'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('credit') }}</strong>
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
