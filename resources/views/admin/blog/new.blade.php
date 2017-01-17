@extends('admin.index')

@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar posteos de su sitio web')



@section('main')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')

	<div class=".col-md-4 center adminBlock">

		
		{!!  link_to_action('BlogController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

		{!! Form::open(['url' => '/admin/blog', 'method'=>'POST']) !!}

			{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
		    {!!Form::text('title', null, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


		    {!!Form::textarea('content', null, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}

		    @foreach ($categories as $category)
		   
			  {!! Form::checkbox('ch[]', $category->id, false ) !!} {!! $category->title !!} </br>

			
		    @endforeach

		    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">



		    {!! Form::submit('Crear posteo!', ['class'=>'btn btn-primary btn-round']); !!}

		{!! Form::close() !!}
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/blog/ajax-admin.js') !!}
	@endsection

@endsection

