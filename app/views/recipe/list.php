<main id="recipeList" class="container">
	<div class="row">
		<?php if($data['recipes']) { ?>
			<?php foreach ($data['recipes'] as $recipe) { ?>
				<a href="<?= $recipe['href'] ?>">
					<article class="col-xs-12 col-sm-12 col-md-3">
						<div>
							<div class="image">
								<img src="<?= $recipe['image'] ?>">
							</div>
							<div class="caption">
								<h3><?= $recipe['name'] ?></h3>
								<p><?= $recipe['description'] ?></p>
							</div>
						</div>
					</article>
				</a>
			<?php } ?>
		<?php } else { ?>
			<h4>There are no recipes to be displayed at this moment.</h4>
		<?php } ?>
	</div>
</main>

