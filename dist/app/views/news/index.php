<?php foreach ($news as $news_items): ?>
	<h3><?=$news_items['title'] ?></h3>

	<div class="main">
		<?=$news_items['text'] ?>
	</div>
	<p><a href="news/<?=$news_items['slug'] ?>">View article</a></p>
<?php endforeach; ?>