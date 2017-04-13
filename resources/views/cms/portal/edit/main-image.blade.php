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
                    {{ $article->title_en }} >&nbsp;
                    Change main photo
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="margin-bottom: 20px">
                        Here you can change the main photo of an article.
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.portal.articles.edit.main-image', ['category' => $category->name_en, 'artID' => $article->artID]) }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Current Image</label>

                            <div class="col-md-6">
                                @if ($article->image != null)
                                <img class="img-responsive" src="{{ asset('storage/images/'.$article->image) }}">
                                @else
                                No image
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image" value="{{ old('image') }}">
                                
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px">
                                    Upload
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.portal.articles', ['category' => $category->name_en]) }}">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                    
                    @if ($article->image != null)
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                    Remove current image
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="modal fade text-center" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Remove current image</h4>
                                </div>

                                <div class="modal-body">
                                    Are you sure?<br/>
                                    <div style="margin-top: 15px">
                                        {{ Form::open(['route' => ['cms.portal.articles.delete.main-image', $category->name_en, $article->artID], 'method' => 'delete', 'class' => 'form-horizontal' ]) }}
                                        {{ Form::submit('Remove current image', array('class' => 'btn btn-danger')) }}
                                        <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
