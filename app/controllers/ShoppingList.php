<?php

class ShoppingListController extends Controller 
{
	public function index()
	{
		echo 'da';
	}

	public function add($id)
	{
		$recipeModel = $this->model('Recipe');

		$recipe = $recipeModel->getRecipe($id);

		if($recipe) {
			if(!isset($this->session->data['cart'][$id])) {
				$this->session->data['cart'][$id] = true;
			
				$this->session->data['success_message'] = sprintf('You have successfully added %s to <a href="%s">shopping list</a>!', $recipe['name'], $this->url->buildUrl('public/shoppinglist'));
			} else {
				$this->session->data['error_message'] = sprintf('%s is already in your <a href="%s">shopping list</a>!', $recipe['name'], $this->url->buildUrl('public/shoppinglist'));
			}

			$this->response->redirect($this->url->buildUrl('public/recipe/show/' . $id));
		} else {
			$this->response->redirect($this->url->buildUrl('public/recipe'));
		} 
	}
}