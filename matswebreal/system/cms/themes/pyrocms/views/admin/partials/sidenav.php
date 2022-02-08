<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <?php echo Asset::img('login-logo.png', "", array('class' => 'user-image img-responsive')) ?>
					</li>
				
					
                     <li>
                        <a class="active-menu"  href="index.php/admin"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                    </li>
                    
                    <?php 

		// Display the menu items.
		// We have already vetted them for permissions
		// in the Admin_Controller, so we can just
		// display them now.
		foreach ($menu_items as $key => $menu_item)
		{
                     if($this->current_user->group_id != 7 && strtoupper(lang_label($key)) === "MEDICAL PROGRAMMES" ){
                                        continue;
                                    }
			if (is_array($menu_item))
			{
				echo '<li><a href="'.current_url().'#" class="top-link">'.lang_label($key).'<span class="fa arrow"></span></a><ul class="nav nav-second-level">';

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
                    <li style="font-size: 11px; margin-top:40px; text-align: center"><a class="active-menu"> Copyright &copy;<?php echo date('Y'); ?> NTBLCP </a></li>
                </ul>
               
            </div>
            
        </nav>



			
			