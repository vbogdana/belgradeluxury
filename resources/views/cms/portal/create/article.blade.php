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
                <div class="panel-heading">
                    <a href="{{ route("cms.portal") }}">Portal ></a>&nbsp;
                    <a href="{{ route("cms.portal.articles", ['category' => $category->name_en]) }}">{{ $category->name_en }} ></a>&nbsp
                    @if(isset($article))
                    Edit Article
                    @else
                    Create Article
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($article))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.portal.articles.edit', ['category' => $category->name_en, 'artID' => $article->artID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.portal.articles.create', ['category' => $category->name_en]) }}">
                    @endif
                        {{ csrf_field() }}                       
                                                                                              
                        <div class="form-group{{ $errors->has("title_en") ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($article) ? $article->title_en : old('title_en') }}" required>

                                @if ($errors->has('title_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('title_sr') ? ' has-error' : '' }}">
                            <label for="title_sr" class="col-md-4 control-label">Title (ser)*</label>

                            <div class="col-md-6">
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($article) ? $article->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        
                        @if (!isset($article))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image (square dimensions)</label>

                            <div class="col-md-6">
                                <input id="image" class='form-control' type="file" name="image" value="{{ old('image') }}">
                                
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category" name="category" class='form-control'>
                                    <?php
                                        if (!isset($article)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>
                                    @foreach($categories as $cat)
                                        <?php 
                                        if (isset($article) && ($article->ctgID !== null) && ($article->ctgID === $cat->ctgID)) {
                                            $selected = "selected";
                                        } else {
                                            if ($category->ctgID === $cat->ctgID) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        }
                                        ?>     
                                    <option value="{{ $cat->ctgID }}" {{ $selected }}>{{ $cat->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                            <label for="description_en" class="col-md-4 control-label">Short Description (eng) *</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="255" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($article) ? $article->description_en : old('description_en') }}</textarea>
                                
                                @if ($errors->has('description_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_sr') ? ' has-error' : '' }}">
                            <label for="description_sr" class="col-md-4 control-label">Short Description (ser) *</label>

                            <div class="col-md-6">
                                <textarea id="description_sr" maxlength="255" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_sr">{{ isset($article) ? $article->description_sr : old('description_sr') }}</textarea>
                                
                                @if ($errors->has('description_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($article))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route("cms.portal.articles", ['category' => $category->name_en]) }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
