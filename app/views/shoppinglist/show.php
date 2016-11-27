<main id="shoppingListShow" class="container">
	<div class="row">
		<div class="col-xs-12">
			<table class="table-hover table-responsive col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
				<thead>
					<tr>
						<th width="20">Checkbox</th>
						<th width="20">Quantity</th>
						<th>Product</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data['ingredientes'] as $ingredient) { ?>
						<tr>
							<td class="text-center"><div class="listCheckbox"></div></td>
							<td class="text-center">1</td>
							<td><?= $ingredient ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row buttons">
		<div class="col-xs-12 text-center">
			<a href="#" class="btn btn-success">Print</a>
			<a href="#" class="btn btn-warning">Email</a>
			<a href="#" class="btn btn-primary">Save</a>
		</div>
	</div>
</main>