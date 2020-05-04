<?php
/**
 * The template for displaying search forms.
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="input-group">
      <input name="s" type="text" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Search content &hellip;', 'unmarked' ); ?>" />
      <span class="input-group-btn">
        <button type="submit" value="Search" class="btn btn-primary" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'unmarked' ); ?>" /><i class="fa fa-search" aria-hidden="true"></i>&nbsp;</button>
      </span>
    </div>
</form>
	
	

	  

