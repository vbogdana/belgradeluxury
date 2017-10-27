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
                    {{ $article->title_en }} >&nbsp;
                    Edit Article Sections
                </div>
                
                <div class="panel-body">                    
                    <div class='container-fluid'>
                            <?php 
                                $images = $article->images->toArray();
                                $paragraphs = $article->paragraphs->toArray();
                                $i = $j = $k = 0;
                                $n = sizeof($images);
                                $m = sizeof($paragraphs);
                            ?>
                    
                            @for($i = $j = $k = 0; $i < $n || $j < $m; $k++)
                            @if($k % 3 === 0 && $k !== 0)
                            </div>
                            @endif
                            @if($k % 3 === 0 || $k === 0)
                            <div class='row'>
                            @endif
                            <div class='col-sm-4'>
                                <div id="content{{ $k+1 }}" 
                                     class='panel-group'
                                     style="cursor: default;">
                                    <h4 class='text-center'>SECTION {{ $k+1 }}</h4>
                                    
                                    <div id="{{ $k+1 }}" class='content'>
                                        @if($j >= $m)
                                        <img src='{{ asset('storage/images/'.$images[$i]['image']) }}' class='img-responsive' />
                                        <br/>
                                        <p>
                                            Caption (eng): {{ $images[$i]['caption_en'] }} <br/>
                                            Caption (ser): {{ $images[$i]['caption_sr'] }} <br/>
                                            Credit: {{ $images[$i]['credit'] }}
                                        </p>
                                        <?php 
                                            $type = "image";
                                            $id = $images[$i]['imgID'];
                                            $i++; 
                                        ?>
                                        @elseif($i >= $n)
                                        <p>
                                            {{ $paragraphs[$j]['content_en'] }}
                                        </p>
                                        <?php 
                                            $type = "paragraph";
                                            $id = $paragraphs[$j]['parID'];
                                            $j++; 
                                        ?>
                                        @elseif ($images[$i]['position'] < $paragraphs[$j]['position'])
                                        <img src='{{ asset('storage/images/'.$images[$i]['image']) }}' class='img-responsive' />
                                        <br/>
                                        <p>
                                            Caption (eng): {{ $images[$i]['caption_en'] }} <br/>
                                            Caption (ser): {{ $images[$i]['caption_sr'] }} <br/>
                                            Credit: {{ $images[$i]['credit'] }}
                                        </p>
                                        <?php 
                                            $type = "image";
                                            $id = $images[$i]['imgID'];
                                            $i++; 
                                        ?>
                                        @elseif ($images[$i]['position'] > $paragraphs[$j]['position'])
                                        <p>
                                            {{ $paragraphs[$j]['content_en'] }}
                                        </p>
                                        <?php 
                                            $type = "paragraph";
                                            $id = $paragraphs[$j]['parID'];
                                            $j++; 
                                        ?>
                                        @endif
                                        
                                        <div class="text-center" style='margin-top: 30px'>
                                            {{ Form::open(['route' => ['cms.portal.articles.edit.section', $category->name_en, $article->artID], 'method' => 'get']) }}
                                            <input type="hidden" name="type" value="{{ $type }}" />
                                            <input type='hidden' name='id' value='{{ $id }}'/>
                                            <button id='submit' type="submit" class="btn btn-default">
                                                EDIT SECTION
                                            </button>
                                            {{ Form::close() }}
                                            
                                            <br/>
                                            
                                            {{ Form::open(['route' => ['cms.portal.articles.delete.section', $category->name_en, $article->artID], 'method' => 'post']) }}
                                            <input type="hidden" name="type" value="{{ $type }}" />
                                            <input type='hidden' name='id' value='{{ $id }}'/>
                                            <button id='submit' type="submit" class="btn btn-danger">
                                                DELETE SECTION
                                            </button>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            
                        @if(($k === 1) || ((($k - 1) > 0) && ((($k - 1) % 3) !== 0)))
                        </div>
                        @endif
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
