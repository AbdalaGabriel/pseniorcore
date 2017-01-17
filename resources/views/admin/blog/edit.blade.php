@extends('admin.index')

@section('pageTitle', 'Administrar posteos')
@section('title', 'Editando Posteo')


@section('main')


<div class=".col-md-4 center adminBlock">


	{!!  link_to_action('BlogController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

	{!! Form::open(['url' => '/admin/blog/'.$finalObj->id, 'method'=>'PUT']) !!}

	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', $finalObj->title, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}

	{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
	<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

	{!!Form::text('urlf', null, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}

	{!!Form::textarea('content', $finalObj->content, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}

	@foreach ($finalObj->categoryData as $category)		    
	@if($category['belongstopost']==true)

	<input checked  data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="ch[]" value="{{$category['catid']}}"> 


	@elseif($category['belongstopost']==false)

	<input data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="ch[]" value="{{$category['catid']}}">

	@endif
	@endforeach

	<input type="hidden" name="_categorydata" value="" id="categorydata">
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	{!! Form::submit('Update post', ['class'=>'btn btn-primary btn-round', 'id' => 'sendForm']); !!}

	{!! Form::close() !!}

</div>


<tbody id="datos"></tbody>

</div>

@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('js/blog/create.js') !!}

{!! Html::script('js/blog/formController.js') !!}
@endsection

@endsection

