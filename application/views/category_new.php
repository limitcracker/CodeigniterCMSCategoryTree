<form id="category_form" name="category_form" method="post" action="<?=base_url()?>categories/category_new">
	<label for="category">Name of the category:</label>
	<input type="text" name="category" id="category" /><br /><br />
	
	Parent Category:
	<select name="parent_category" id="parent_category">
		<?php $tree->preorder_trav($root, $space_counter=0); ?>
	</select>

	<br /><br />
	<input type="submit" value="Insert to DB" />
	<input type="reset" value="Clear" />
</form>

