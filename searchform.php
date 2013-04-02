<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-search">
	<div class="input-append">
		<input type="text" class="span2 search-query" value="<?php the_search_query(); ?>" name="s" id="search" >
		<button type="submit" class="btn btn-inverse"><i class="icon-search icon-white" style="margin-left: -6px;"></i>&nbsp;Search</button>
</div>