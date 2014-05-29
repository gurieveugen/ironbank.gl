<?php $sq = get_search_query() ? get_search_query() : ''; ?>
<form action="<?php bloginfo('url'); ?>" method="get" class="search-form">
	<fieldset>
		<input type="text" name="s" value="<?php echo $sq; ?>" placeholder="SEARCH SITE" class="text" />
		<input class="btn-search" type="submit" value="Search"/>
	</fieldset>
</form>