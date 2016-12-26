@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Editando página')

@section('menu')
<li>
	<a href="dashboard.html">
		<i class="material-icons">dashboard</i>
		<p>Dashboard</p>
	</a>
</li>
<li>
	<a href="user.html">
		<i class="material-icons">person</i>
		<p>Blog</p>
	</a>
</li>

<li class="active">
	<a href="user.html">
		<i class="material-icons">person</i>
		<p>Páginas</p>
	</a>
</li>

@endsection

@section('main')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')

	<div class=".col-md-4 center adminBlock">

		
		{!!  link_to_action('BlogController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

		{!! Form::open(['url' => 'http://localhost:8000/admin/blog', 'method'=>'POST']) !!}

			{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
		    {!!Form::text('title', $finalObj->title, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


		    {!!Form::textarea('content', $finalObj->content, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}

		    @foreach ($finalObj->categoryData as $category)		    
		       @if($category['belongstopost']==true)

			  		<input checked  data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="" value="{{$category['catid']}}">

			   @elseif($category['belongstopost']==false)

			   		<input data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="" value="{{$category['catid']}}">

			   @endif
		    @endforeach

		    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

		    {!! Form::submit('Update post', ['class'=>'btn btn-primary btn-round']); !!}

		{!! Form::close() !!}
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!! Html::script('js/pages/ajax-admin.js') !!}
	@endsection

@endsection

