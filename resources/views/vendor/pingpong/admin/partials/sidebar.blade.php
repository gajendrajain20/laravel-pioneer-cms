<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! Auth::user()->gravatar() !!}" class="img-circle" alt="{!! Auth::user()->name !!}"/>
            </div>
            <div class="pull-left info">
                <p>Hello, {!! Auth::user()->name !!}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        
		{{--  {!! Menu::getById(Auth::user()) !!} --}}
		
		{!! Menu::get('dashboard-menu') !!} 
		
		@if (Auth::user() != null)
		
    		@if (Auth::user()->can('manage_articles'))
    			{!! Menu::get('posts-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_pages'))
    			{!! Menu::get('pages-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_videos'))
    			{!! Menu::get('videos-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_menus'))
    			{!! Menu::get('menus-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_widgets'))
    			{!! Menu::get('widgets-menu') !!}
    		@endif
			@if (Auth::user()->can('manage_templates'))
    			{!! Menu::get('templates-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_contacts'))
    			{!! Menu::get('contacts-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_modules'))
    			{!! Menu::get('modules-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_news'))
    			{!! Menu::get('news-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_positions'))
    			{!! Menu::get('positions-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_users'))
    			{!! Menu::get('users-menu') !!}
    		@endif
    		@if (Auth::user()->can('manage_settings'))
    			{!! Menu::get('settings-menu') !!}
    		@endif
    	@endif
		
    </section>
    <!-- /.sidebar -->
</aside>
