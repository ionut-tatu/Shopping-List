<main id="recipe" class="container">
	<?php if($data['error_message']) { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $data['error_message'] ?>
		</div>
	<?php } ?>

	<?php if($data['success_message']) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $data['success_message'] ?>
		</div>
	<?php } ?>

	<div class="row recipeNavigation">
		<div class="col-xs-12 col-sm-6 text-left"><a href="<?= $data['recipe']['previousRecipe'] ?>">&laquo; Previous Recipe</a></div>
		<div class="col-xs-12 col-sm-6 text-right"><a href="<?= $data['recipe']['nextRecipe'] ?>">Next Recipe &raquo;</a></div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4">
			<img src="<?= $data['recipe']['image'] ?>" ?>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-4 description">
			<h3><?= $data['recipe']['name'] ?></h3>
			<p><?= $data['recipe']['description'] ?></p>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-4 ingredientesList">
			<h3>Ingredients</h3>

			<?= $data['recipe']['ingredientes'] ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 text-center addToCart">
			<a href="<?= $data['recipe']['addToCartUrl'] ?>" class="btn btn-success">Add to Shopping List</a> or <a href="<?= $data['recipe']['backUrl'] ?>">Back to list</a>
		</div>
	</div>
</main>