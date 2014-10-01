<div id="left-side" role="complementary">	
	<div id="scrollbar1">    		
		<div class="scrollbar">			
			<div class="track">				
				<div class="thumb">					
					<div class="end"></div>				
				</div>			
			</div>		
		</div>    		
		<div class="viewport">        			
			<div class="overview">						
				<?php wp_nav_menu( array( 														
					'container'       => 'div',														
					'container_class' => 'left-side-menu',														
					'theme_location' => 'sidebar_menu',
					'menu_id' => 'menu-main-menu'													
					)); 				
				?>                    			
			</div>    		
		</div>	
	</div>
</div>