@extends($layout)

@section('content-header')
	<h1>
	Settings
	</h1>
@stop

@section('content')

<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#general" data-toggle="tab">General</a></li>
        <li style="display: none;"><a href="#data" data-toggle="tab">Data</a></li>
	<li><a href="#social" data-toggle="tab">Social Media</a></li>
	<li style="display: none;"><a href="#seo" data-toggle="tab">SEO</a></li>
	<li><a href="#analytics" data-toggle="tab">Analytics</a></li>
	<li style="display: none;"><a href="#backup" data-toggle="tab">Cache And Reset</a></li>
	<li style="display: none;"><a href="#developers" data-toggle="tab">Developers</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="general">
		<h3></h3>
		{!! Form::open(['files' => true]) !!}
		<div class="form-group">
			{!! Form::label('site.name', 'Site Name:') !!}
			{!! Form::text('site.name', option('site.name'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.name', '<div class="text-danger">:message</div>') !!}
                        
		</div>
        
		<div class="form-group">
			<div >
			{!! Form::label('site.logo', 'Site Logo:') !!}
			{!! Form::file('site.logo', ['class' => 'form-control']) !!}
			{!! $errors->first('site.logo', '<div class="text-danger">:message</div>') !!}
            {{Form::getValueAttribute('site.logo')}}
			<div class="form-group" style="padding: 10px;">
				@if(null != option('site.logo')) <img class="img-responsive logos" src="{!! asset('images/site/' . option('site.logo')) !!}"> @endif
			</div>
			</div>
		</div>
                <div class="form-group">
			{!! Form::label('site.footer.logo', 'Site Footer Logo:') !!}
			{!! Form::file('site.footer.logo', ['class' => 'form-control']) !!}
			{!! $errors->first('site.footer.logo', '<div class="text-danger">:message</div>') !!}
			<div class="form-group" style="padding: 10px;">
				@if(null != option('site.footer.logo')) <img class="img-responsive logos" src="{!! asset('images/site/' . option('site.footer.logo')) !!}"> @endif
			</div>
		</div>
                <div class="form-group">
			{!! Form::label('site.favicon', 'Site Favicon:') !!}
			{!! Form::file('site.favicon', ['class' => 'form-control']) !!}
			{!! $errors->first('site.favicon', '<div class="text-danger">:message</div>') !!}
			<div class="form-group" style="padding: 10px;">
				@if(null != option('site.favicon')) <img class="img-responsive logos" src="{!! asset('images/site/' . option('site.favicon')) !!}"> @endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('site.slogan', 'Site Default Meta Title:') !!}
			{!! Form::text('site.slogan', option('site.slogan'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.slogan', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('site.description', 'Site Default Meta Description:') !!}
			{!! Form::textarea('site.description', option('site.description'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.description', '<div class="text-danger">:message</div>') !!}
		</div>
        <div class="form-group">
			{!! Form::label('site.keywords', 'Keyword:') !!}
			{!! Form::text('site.keywords', option('site.keywords'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.keywords', '<div class="text-danger">:message</div>') !!}
		</div>
        <div class="form-group">
			{!! Form::label('site.email', 'Site Email:') !!}
			{!! Form::text('site.email', option('site.email'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.email', '<div class="text-danger">:message</div>') !!}
		</div>
        <div class="form-group">
			{!! Form::label('site.hotline', 'Hotline:') !!}
			{!! Form::text('site.hotline', option('site.hotline'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.hotline', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('site.copyright', 'Copyright:') !!}
			{!! Form::text('site.copyright', option('site.copyright'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.copyright', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
	<div class="tab-pane" id="data">
		<h3></h3>
		{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('pagination.perpage', 'Pagination Per Page:') !!}
			{!! Form::text('pagination.perpage', option('pagination.perpage'), ['class' => 'form-control']) !!}
			{!! $errors->first('pagination.perpage', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
	<div class="tab-pane" id="developers">
		<h3></h3>
		{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('ckfinder.prefix', 'CKFinder Prefix Path:') !!}
			{!! Form::text('ckfinder.prefix', option('ckfinder.prefix'), ['class' => 'form-control']) !!}
			{!! $errors->first('ckfinder.prefix', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group hidden">
			{!! Form::label('admin.theme', 'Admin Theme:') !!}
			{!! Form::select('admin.theme', $themes, option('admin.theme'), ['class' => 'form-control']) !!}
			{!! $errors->first('admin.theme', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
	<div class="tab-pane" id="backup">
		<h3></h3>
		@if(defined("STDIN"))
		<p>
			{!! modal_popup(route('admin.reinstall'), 'Reinstall Website', 'Anda yakin ingin menginstall ulang website ini ?')!!}
		</p>
		<p>
			{!! modal_popup(route('admin.cache.clear'), 'Clear Cache', 'Anda yakin ingin menghapus cache?')!!}
		</p>
		@else
		<div class="alert alert-warning">
			<p>
				Sorry, your server is not support artisan via interface.
			</p>
		</div>
		@endif
	</div>
	<div class="tab-pane" id="seo">
		<h3></h3>
		{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('site.keywords', 'Keyword:') !!}
			{!! Form::text('site.keywords', option('site.keywords'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.keywords', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('post.permalink', 'Post Permalink:') !!}
			{!! Form::text('post.permalink', option('post.permalink'), ['class' => 'form-control']) !!}
			{!! $errors->first('post.permalink', '<div class="text-danger">:message</div>') !!}
			<p class="help-block">Permalink URL for article or page.</p>
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
	<div class="tab-pane" id="social">
		<h3></h3>
		{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('facebook.link', 'Facebook Link:') !!}
			{!! Form::text('facebook.link', option('facebook.link'), ['class' => 'form-control']) !!}
			{!! $errors->first('facebook.link', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('twitter.link', 'Twitter Link:') !!}
			{!! Form::text('twitter.link', option('twitter.link'), ['class' => 'form-control']) !!}
			{!! $errors->first('twitter.link', '<div class="text-danger">:message</div>') !!}
		</div>
                <div class="form-group">
			{!! Form::label('google.link', 'Google+ Link:') !!}
			{!! Form::text('google.link', option('google.link'), ['class' => 'form-control']) !!}
			{!! $errors->first('google.link', '<div class="text-danger">:message</div>') !!}
		</div>
                
                <div class="form-group">
			{!! Form::label('site.android', 'Adroid App Link:') !!}
			{!! Form::text('site.android', option('site.android'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.android', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('site.apple', 'IOS App Link:') !!}
			{!! Form::text('site.apple', option('site.apple'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.apple', '<div class="text-danger">:message</div>') !!}
		</div>
                <div class="form-group">
			{!! Form::label('site.youtube', 'Youtube Link:') !!}
			{!! Form::text('site.youtube', option('site.youtube'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.youtube', '<div class="text-danger">:message</div>') !!}
		</div>
                
                <div class="form-group">
			{!! Form::label('site.linkedin', 'Linkedin Link:') !!}
			{!! Form::text('site.linkedin', option('site.linkedin'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.linkedin', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('site.rss', 'Rss Link:') !!}
			{!! Form::text('site.rss', option('site.rss'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.rss', '<div class="text-danger">:message</div>') !!}
		</div>
                <div class="form-group">
			{!! Form::label('site.mail', 'Mail Address:') !!}
			{!! Form::text('site.mail', option('site.mail'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.mail', '<div class="text-danger">:message</div>') !!}
		</div>
                
                <div class="form-group">
			{!! Form::label('site.alert', 'Alert Link:') !!}
			{!! Form::text('site.alert', option('site.alert'), ['class' => 'form-control']) !!}
			{!! $errors->first('site.alert', '<div class="text-danger">:message</div>') !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
	<div class="tab-pane" id="analytics">
		<h3></h3>
		{!! Form::open() !!}
		<div class="form-group">
			{!! Form::label('tracking', 'Tracking Script:') !!}
			{!! Form::textarea('tracking', option('tracking'), ['class' => 'form-control']) !!}
			{!! $errors->first('tracking', '<div class="text-danger">:message</div>') !!}
			<p class="help-block">
				To append this script just add : <span class="muted">@{!! option('tracking') !!}</span> on your view.
			</p>
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>
</div>

@stop
