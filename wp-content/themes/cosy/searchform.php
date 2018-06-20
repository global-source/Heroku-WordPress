<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<input autocomplete="off" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here&hellip;', 'placeholder', 'cosy' ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'cosy' ); ?>" />
	<button class="search-button" type="submit"><i class="cosy-icon-zoom"></i></button>
</form>
<!-- .search-form -->