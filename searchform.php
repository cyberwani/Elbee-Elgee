<?php if (!is_search()) {
	$search_text = 'Search...';
} else {
	$search_text = "$s";
}
?>

<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">        
	<input type="text" id="s" name="s" value="<?php echo wp_specialchars($search_text, 1); ?>" onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}"/>
	<input type="hidden" id="searchsubmit" value="Search" />
</form>

