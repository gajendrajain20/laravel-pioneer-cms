<?php
		      if(!function_exists('createHierarchy')){

    			function createHierarchy($tree, $temp, $model = array() ,$r = 0, $p = null, $index = 0) {
    				foreach ($tree as $i => $t) { ?>
    					<li>	
    					{!!Form::checkbox('category_id['.$index++ .']', $t['id'],
    						(isset($model) && in_array($t['id'], $model['category_id']))? true:"", ['class' =>'form-control']) !!}
    						{{$t['title']}} 
    					</li>	
    					<?php 
    					if ($t['parent'] == $p) {
    						// reset $r
    						$r = 0;
    					}
    					if (isset($t['_children'])) { ?>
    						<ul>
    					<?php	$temp =createHierarchy($t['_children'],$temp, $model, ++$r, $t['parent'], $index); ?>
    						</ul>
    				<?php	}
    				}
    				return $temp;
    			}
	       }
		?>

<fieldset>
	<ul>
		<?php if(($categories != null) && (!empty(array_filter($categories)))){
		          
		          createHierarchy($categories, $temp=array(), isset($model)?$model:null);
		          unset($index);
				}else{ ?>
					<p>No Categories found, Please Create a category first.</p>
	<?php		}  ?>
		
	</ul>
</fieldset>

