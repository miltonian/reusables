<?php 

$urltitleone = str_replace(' ', '', $featuredposts[0]['title']);
$urltitletwo = str_replace(' ', '', $featuredposts[1]['title']);
$urltitlethree = str_replace(' ', '', $featuredposts[2]['title']);

?>


<style>
</style>

<div class="featured_inline <?php echo $identifier ?>">
	<a href="/post/<?php echo $featuredposts[0]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $featuredposts[0]['title'] ); ?>"><div class="post one" style="background-image: url(<?php echo $featuredposts[0]['featured_imagepath'] ?>">
		<div class="gradient"></div>
		<label class="title"><?php echo $featuredposts[0]['title'] ?></label>
	</div></a>
	<a href="/post/<?php echo $featuredposts[1]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $featuredposts[1]['title'] );  ?>"><div class="post two" style="background-image: url(<?php echo $featuredposts[1]['featured_imagepath'] ?>">
		<div class="gradient"></div>
		<label class="title"><?php echo $featuredposts[1]['title'] ?></label>
	</div></a>
	<a href="/post/<?php echo $featuredposts[2]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $featuredposts[2]['title'] ); ?>"><div class="post three" style="background-image: url(<?php echo $featuredposts[2]['featured_imagepath'] ?>">
		<div class="gradient"></div>
		<label class="title"><?php echo $featuredposts[2]['title'] ?></label>
	</div></a>
</div>

<script>
	
	class FeaturedInlineClass {
		
		
		
	}
	
</script>