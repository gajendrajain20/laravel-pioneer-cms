 <nav id="main-nav" role="navigation" class="collapse navbar-collapse" >
	
	<ul id="main-menu" class="sm sm-clean">
		<?php	
			populateMenu($menuArray, 0);
			function populateMenu($menus, $r=0) {
				foreach($menus as $index => $menu){
					$url = (($menu['custom'] != '' && $menu['custom']!=null) ? $menu['custom'] : $menu['url']);
					
					if (isset($menu["_children"])) {
						$r++;
					?>	 <li> 
						<a href="{{ url($url) }}">{{ $menu['title'] }}</a>
							<ul>
								<?php
									populateMenu($menu['_children'],$r);
									$r--;
								?>
							</ul>
						</li>					
					<?php } else { ?>
						<li><a href="{{ url($url) }}">{{ $menu['title'] }}</a></li>
					<?php
					}
					//reset url variable
					$url = '';
				}
				 
			}
		?>
	</ul>
</nav>