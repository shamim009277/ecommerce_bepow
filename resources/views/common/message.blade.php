<!-- @if(Session::has('flash_message'))
  	<div style="font-size: 18px;font-style: italic;margin-top:15px;font-weight: bold;" class="alert alert-{{ session('status_color') }}">
  		<span class="fa fa-check-square-o"></span><em> {!! session('flash_message') !!}</em>
  	</div>
@endif -->

@if(Session::has('flash_message'))
  	<div class="alert alert-{{ session('status_color') }} alert-dismissible fade show" role="alert">
	  <strong></strong> {!! session('flash_message') !!}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
</div>
@endif