<?php
$page = Input::get('page');
if(is_null($page)) $page = 1;

if ($page >= $totalPages) {
	$noNext = true;
}
else {
	$noNext = false;
}

if(!Input::has('page') or $page == 1){ ?>

	<ul class="pager">
	  	<li class="disabled"><a href="#">&larr; Previous</a></li>
	  	<?php if($noNext == true) { ?>
	  	<li class="disabled"><a href="#">Next &rarr;</a></li>
	  	<?php } else { ?>
	  	<li><a href="?page=2">Next &rarr;</a></li>
	  	<?php } ?>
	</ul>

<?php }
else
{
	$nextPage =  $page+1;
	$prevPage =  $page-1;
?>

	<ul class="pager">
	  	<li><a href="?page={{$prevPage}}">&larr; Previous</a></li>
	  	<?php if($noNext == true) { ?>
	  	<li class="disabled"><a href="#">Next &rarr;</a></li>
	  	<?php } else { ?>
	  	<li><a href="?page={{$nextPage}}">Next &rarr;</a></li>
	  	<?php } ?>
	</ul>

<?php } ?>