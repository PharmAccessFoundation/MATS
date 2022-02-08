<ul class="primary-nav">
	
	<li id="dashboard-link"><?php echo anchor('admin', lang('global:dashboard'), 'class="top-link '.( ! $this->module ? 'current ' : '').'"') ?></li>

		<?php 

		// Display the menu items.
		// We have already vetted them for permissions
		// in the Admin_Controller, so we can just
		// display them now.
		foreach ($menu_items as $key => $menu_item)
		{
			if (is_array($menu_item))
			{
				echo '<li><a href="'.current_url().'#" class="top-link">'.lang_label($key).'</a><ul>';

				foreach ($menu_item as $lang_key => $uri)
				{
                                    if(strtoupper(lang_label($lang_key)) === "EDIT PROFILE"){
					echo '<li><a href="'.site_url($uri).'" class="">'.lang_label($lang_key).'</a></li>';
                                    }
                                    else if((strtoupper(lang_label($lang_key)) === "HEALTH WORKERS" || strtoupper(lang_label($lang_key)) === "MEDICAL FACILITIES") && $this->current_user->group_id == 5 ){
					continue; //echo '<li><a href="'.site_url($uri).'" class="">'.lang_label($lang_key).'</a></li>';
                                    }else{
                                        echo '<li><a href="'.site_url($uri).'" class="">'.lang_label($lang_key).'</a></li>';
                                    }
                                     
				}

				echo '</ul></li>';

			}
			elseif (is_array($menu_item) and count($menu_item) == 1)
			{
				foreach ($menu_item as $lang_key => $uri)
				{
					echo '<li><a href="'.site_url($menu_item).'" class="top-link no-submenu">'.lang_label($lang_key).'</a></li>';
				}
			}
			elseif (is_string($menu_item))
			{
				echo '<li><a href="'.site_url($menu_item).'" class="top-link no-submenu">'.lang_label($key).'</a></li>';
			}

		}
	
		?>

</ul>