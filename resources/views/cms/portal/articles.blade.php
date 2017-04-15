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
                    <a href="{{ route("cms.portal") }}">Portal ></a>&nbsp
                    {{ $category->name_en }} >&nbsp
                    All articles
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.portal.articles.create', ['category' => $category->name_en]) }}">New article</a>
                </div>
                @if(app('request')->input('message') === 'fail')
                <div class="alert alert-danger">
                    <strong>Info!</strong> The article is tied to an event. You must delete the event in order to delete the article.
                </div>
                @endif

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete an article select 'Delete an article'.<br/>
                        To edit an article select 'Edit article'.<br/>
                        To edit main photo of an article select 'Edit main photo'.<br/>
                    </div>
                    @foreach($articles as $article)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($article->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$article->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <h4>{{ $article->title_en }}</h4>
                            <strong>Author: {{ $article->author->name }}</strong>
                            <p>
                                Created: {{ $article->created_at }}
                                <br/>
                                Updated: {{ $article->updated_at }}
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.portal.articles.create.content', $category->name_en, $article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Create content', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.portal.articles.reorder', $category->name_en, $article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Edit content', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.portal.articles.edit', $category->name_en, $article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.portal.articles.edit.main-image', $category->name_en, $article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Edit article photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$article->artID}}">
                                Delete an article
                            </button>
                            <div class="modal fade" id="myModal{{$article->artID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete an article</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.portal.articles.delete', $category->name_en, $article->artID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete article', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
