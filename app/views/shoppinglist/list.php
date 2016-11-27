<main id="shoppingListList" class="container">

	<?php if($data['success_message']) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $data['success_message'] ?>
		</div>
	<?php } ?>

	<div class="row">
		<div class="col-xs-12">
			<?php if($data['recipes']) { ?>
				<table class="table table-bordered table-hover table-responsive">
					<thead>
						<tr>
							<th>#</th>
							<th>Image</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php foreach ($data['recipes'] as $key => $recipe) { ?>
					<tr>
						<td><?= $key + 1 ?></td>
						<td><img src="<?= $recipe['image'] ?>" /></td>
						<td><?= $recipe['name'] ?></td>
						<td><a href="<?= $recipe['remove'] ?>"><i class="fa fa-trash-o"></i></a></td>
					</tr>
				<?php } ?>
					</tbody>
				</table>

				<a href="#" class="btn btn-success">Generate Shopping List</a>
			<?php } else { ?>
				<h4>There are no recipes in your shopping list. <a href="<?= $data['recipeUrl'] ?>">See recipes list.</a></h4>
			<?php } ?>
		</div>
	</div>
</main>

