@extends('admin.index')

@section('pageTitle', 'Administrar proyectos')
@section('title', 'Editando Proyecto')


@section('main')


<div class=".col-md-4 center adminBlock">


	{!!  link_to_action('ProjectController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

	{!! Form::open(['url' => 'http://localhost:8000/admin/portfolio/'.$finalObj->id, 'method'=>'PUT']) !!}

	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', $finalObj->title, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


	{!!Form::textarea('content', $finalObj->content, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}

	@foreach ($finalObj->categoryData as $category)		    
	@if($category['belongstoproyect']==true)

	<input checked  data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="ch[]" value="{{$category['catid']}}"> 


	@elseif($category['belongstoproyect']==false)

	<input data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="ch[]" value="{{$category['catid']}}">

	@endif
	@endforeach

	<input type="hidden" name="_categorydata" value="" id="categorydata">
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	{!! Form::submit('Update project', ['class'=>'btn btn-primary btn-round']); !!}

	{!! Form::close() !!}

</div>


<tbody id="datos"></tbody>

</div>

@section('aditional-scripts')
{!! Html::script('js/blog/create.js') !!}
@endsection

@endsection

