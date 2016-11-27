<!doctype html>
<html>
<head>
<title>My shopping list</title>
<?php foreach($data['stylesheets'] as $stylesheet) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>" />
<?php } ?>
</head>
<body>

<header id="navWrapper">
	<div class="container">
		<div class="row">
			<nav id="navigation" class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
				<a href="<?= $data['recipeUrl'] ?>" class="<?= $data['current_location'] == 'recipe' ? 'selected' : '' ?>"><i class="fa fa-cutlery"></i> <span>Recipes</span></a>
				<a href="<?= $data['shoppingListUrl'] ?>" class="<?= $data['current_location'] == 'shoppinglist' ? 'selected' : '' ?>"><i class="fa fa-list"></i> <span>Shopping List</span></a>
			</nav>
		</div>
	</div>
</header>
