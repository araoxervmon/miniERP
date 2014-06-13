<?php 
	$modules = $this->fuel_modules->get_modules();
	$mods = array();
	foreach($modules as $mod)
		{
		if(isset($mod['module_uri']))
		{
			$mods[$mod['module_uri']] = isset($mod['permission']) ? $mod['permission'] : '';
		}
		}	
	foreach($nav as $section => $nav_items)
		{
			if (is_array($nav_items))
			{
				$header_written = FALSE;
				foreach($nav_items as $key => $val)
				{
					$segments = explode('/', $key);
					$url = $key;                                
					$key = isset($mods[$key]) ? $mods[$key] : $key;
					$nav_selected = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $this->nav_selected));

					if (($this->fuel_auth->has_permission($key)) || $key == 'dashboard')
					{
						$section_hdr = lang('section_'.$section);
					if (empty($section_hdr))
					{
						$section_hdr = ucfirst(str_replace('_', ' ', $section));
					}	
					
						if  (!$header_written)
						{
							echo "<span class=\"left_nav_section\" id=\"leftnav_".$section."\">";
							echo "<h3 class= $section onclick=sidebarHide('$section');>".$section_hdr."</h3>";
							echo "<ul id= $section style='display:inline;'>";
							echo "<li style='width:200px !important; padding:0px !important; white-space:normal !important;'>";
						}
						echo "\t\t<li";
						if (preg_match('#^'.$nav_selected.'$#', $url))
						{
							echo ' class="active"';
						}
						echo "><a href=\"".fuel_url($url)."\" class=\"ico ico_".url_title(str_replace('/', '_', $key),'_', TRUE)."\">".$val."</a></li>\n";
						$header_written = TRUE;
					}
				}
			}
			if  ($header_written)
			{
				echo "</li>";
				echo "</ul>";
				echo "</span>";
			}
			}
?>
<!--
<?php $user_data = $this->fuel_auth->user_data();
	  if (isset($user_data['recent'])) : ?>
	  <span class=\"left_nav_section\" id=\"leftnav_recent_apps\">
	  <h3> Recent Apps </h3>
	  <ul>
		<?php foreach($user_data['recent'] as $val) : ?>
		<li><a href="<?=site_url($val['link'])?>" class="ico ico_<?=$val['type']?>" title="<?=$val['name']?>"><?=$val['name']?></a></li>
		<?php endforeach; ?>
	  </ul>
	  </span>
<?php endif; ?>	
-->