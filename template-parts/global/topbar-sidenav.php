<?php
	if ($post->post_parent)	{
		$ancestors=get_post_ancestors($post->ID);
		$root=count($ancestors)-1;
		$parent = $ancestors[$root];
	} else {
		$parent = $post->ID;
	}

	$parentpost = get_post($parent);
?>

<aside class="sidebarNav">
	<div class="subnav-header"><a href="<?php echo get_permalink($parentpost); ?>"><?php echo $parentpost->post_title; ?></a></div>

	<div class="menu-main-container">
		<ul class="menu">
			<?php 
				wp_list_pages( 
					array(
		        		'title_li'    => '',
		        		'child_of'    => $parent,
		        		'show_date'   => 'modified',
		        		'date_format' => $date_format,
		    		) 
		    	);
			?>
			<li class="page_item"><a href="https://www.pta-events.co.uk/#.WpVvv6hl9aR" target="_blank">Book Tickets</a></li>
		</ul>
	</div>
</aside>
