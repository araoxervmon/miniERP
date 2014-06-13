<?php 
	$modules = $this->fuel_modules->get_modules();
	$mods = array();
	foreach($modules as $mod) {
		if(isset($mod['module_uri'])) {
			$mods[$mod['module_uri']] = isset($mod['permission']) ? $mod['permission'] : '';
		}
	}
	
	echo " <div class='navbar navbar-static' style='position: absolute;left: 267px;top: -9px;'>";
	echo " <div class='navbar-inner' style='display: inline-block;'>";
	echo "<ul class='nav' role='navigation' id='topMenu'>";
	
	foreach($nav as $section => $nav_items)
	{
		if(!is_array($nav_items)) {
			continue;
		}
		if (count($nav_items)>1) {
			//If it has multiple items
			$header_written = FALSE;
			foreach($nav_items as $key => $val) {
				$segments = explode('/', $key);
				$url = $key;          				
				$key = isset($mods[$key]) ? $mods[$key] : $key;
				$nav_selected = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $this->nav_selected));
				//$selectednav = 
				//echo $nav_selected;

				if (($this->fuel_auth->has_permission($key))) {
					$section_hdr = lang('section_'.$section);
					if (empty($section_hdr)) {
						$section_hdr = ucfirst(str_replace('_', ' ', $section));
					}		
					if (in_array($section, $this->config->item('apps_view', 'fuel')) || in_array($section, $this->config->item('settings_view', 'fuel'))){
						if  (!$header_written) {
							//echo $section;
							echo " <li class='dropdown'>";
							echo "<a href='#' id='drop2' role='button' class='dropdown-toggle' data-toggle='dropdown'><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $section),'_', TRUE)."\"></i>&nbsp;&nbsp; $section_hdr <b class='caret'></b></a> ";
							echo "<ul class='dropdown-menu' role='menu' aria-labelledby='drop2'>";
						}
						if($key == $nav_selected){
							if(is_array($val)){
							 echo "<li class='dropdown-submenu'><a tabindex='-1' title=\"".$key."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$key."</a>";
								echo '<ul class="dropdown-menu">';
								foreach($val as $sub_key=>$sub_val){
									$sub_url = $sub_key;          				
									$sub_key = isset($mods[$sub_key]) ? $mods[$sub_key] : $sub_key;
									echo "<li><a tabindex='-1' title=\"".$sub_val."\" href=\"".fuel_url($sub_url)."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $sub_key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$sub_val."</a></li>";
								}
								echo '</ul>';
							echo '</li>';
							}else{
								echo "<li><a tabindex='-1' title=\"".$val."\" href=\"".fuel_url($url)."\" style='color:#71C5EF;' ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$val."</a></li>";
							 }
						} else{	
							 if(is_array($val)){
							 echo "<li class='dropdown-submenu'><a tabindex='-1' title=\"".$key."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$key."</a>";
								echo '<ul class="dropdown-menu">';
								foreach($val as $sub_key=>$sub_val){
									$sub_url = $sub_key;   
									//echo $sub_key;       				
									$sub_key = isset($mods[$sub_key]) ? $mods[$sub_key] : $sub_key;
									echo "<li><a tabindex='-1' title=\"".$sub_val."\" href=\"".fuel_url($sub_url)."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $sub_key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$sub_val."</a></li>";
								}
								echo '</ul>';
							 echo '</li>';
							 }else{
								echo "<li><a tabindex='-1' title=\"".$val."\" href=\"".fuel_url($url)."\" style='color:#71C5EF;' ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$val."</a></li>";			 
							 }
						}
						
						$header_written = TRUE;
					}
				} 
			}
			if  ($header_written) {
				 echo "</ul>";
				 echo"</li>";
			}
		} else {
			// If it has only a single item show it directly, without a drop-down
			$keys = array_keys($nav_items);
			if(count($keys)>0) {
				$key = $keys[0];
				$val = $nav_items[$keys[0]];
				$segments = explode('/', $key);
				$url = $key;          				
				$key = isset($mods[$key]) ? $mods[$key] : $key;
				$nav_selected = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $this->nav_selected));
				//$selectednav = 
				//echo $nav_selected;
	
				if (($this->fuel_auth->has_permission($key))) {
					$section_hdr = lang('section_'.$section);
					if (empty($section_hdr)) {
						$section_hdr = ucfirst(str_replace('_', ' ', $section));
					}
					if (in_array($section, $this->config->item('apps_view', 'fuel')) || in_array($section, $this->config->item('settings_view', 'fuel'))){
						if($key == $nav_selected){
							 if(is_array($val)){
							 echo "<li class='dropdown-submenu'><a tabindex='-1' title=\"".$key."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$key."</a>";
								echo '<ul class="dropdown-menu">';
								foreach($val as $sub_key=>$sub_val){
									$sub_url = $sub_key;          				
									$sub_key = isset($mods[$sub_key]) ? $mods[$sub_key] : $sub_key;
									echo "<li><a tabindex='-1' title=\"".$sub_val."\" href=\"".fuel_url($sub_url)."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $sub_key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$sub_val."</a></li>";
								}
								echo '</ul>';
							 echo '</li>';
							}else{
							echo "<li><a tabindex='-1' title=\"".$val."\" href=\"".fuel_url($url)."\" style='color:#71C5EF;' ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$val."</a></li>";					 
							}	
						} else{	
							if(is_array($val)){
							 echo "<li class='dropdown-submenu'><a tabindex='-1' title=\"".$key."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$key."</a>";
								echo '<ul class="dropdown-menu">';
								foreach($val as $sub_key=>$sub_val){
									$sub_url = $sub_key;          				
									$sub_key = isset($mods[$sub_key]) ? $mods[$sub_key] : $sub_key;
									echo "<li><a tabindex='-1' title=\"".$sub_val."\" href=\"".fuel_url($sub_url)."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $sub_key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$sub_val."</a></li>";
								}
								echo '</ul>';
							 echo '</li>';	
							}else{
							 echo "<li><a tabindex='-1' title=\"".$val."\" href=\"".fuel_url($url)."\" ><i class=\"icon-xervmon-settings icon-" . url_title(str_replace('/', '_', $key),'_', TRUE)."\"></i>&nbsp;&nbsp;".$val."</a></li>";
							}
						}
					}
				}
			}
		}
	}

			echo "</ul>";
			echo "</div>";
			echo "</div>";
?>
<!--
	<?php $user_data = $this->fuel_auth->user_data();
		  if (isset($user_data['recent'])) : ?>
		  <span class=\"left_nav_section\" id=\"leftnav_recent_apps\">
		  <h3> Recent Apps </h3>
		  <ul style='display:inline !important;'>
		  <?php foreach($user_data['recent'] as $val) : ?>
		  <li style='width:200px !important; padding:0px !important; white-space:normal !important;'>
		  <div style='width:95px !important; padding:0px !important; float:left; height:95px !important;'> <div align='center' style='padding:2px 0px;'>  
		  <a href="<?=site_url($val['link'])?>" class="ico_app_nav ico_app_nav_<?=$val['type']?>" title="<?=$val['name']?>"style="text-decoration:none !important;">&nbsp;</a>
		  </div><div align='center' style='font-size:11px !important; padding:0px 0px 3px;'>
		  </div></div>
		  </li>
		  <?php endforeach; ?>
		  </ul>
		  </span>
	<?php endif; ?>
-->	  
