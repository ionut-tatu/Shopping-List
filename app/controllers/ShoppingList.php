<?php

class ShoppingListController extends Controller 
{
	private $current_location = 'shoppinglist';

	public function index()
	{

		$data['recipeUrl'] = $this->url->buildUrl('public/recipe');
		$data['shoppingListUrl'] = $this->url->buildUrl('public/shoppinglist');
		$data['current_location'] = $this->current_location;

		if(isset($this->session->data['error_message'])) {
			$data['error_message'] = $this->session->data['error_message'];
			unset($this->session->data['error_message']);
		} else {
			$data['error_message'] = '';
		}

		if(isset($this->session->data['success_message'])) {
			$data['success_message'] = $this->session->data['success_message'];
			unset($this->session->data['success_message']);
		} else {
			$data['success_message'] = '';
		}

		$data['stylesheets'] = $this->getStylesheets();

		$recipeModel = $this->model('Recipe');

		$data['recipes'] = [];
		if(isset($this->session->data['cart']) && !empty($this->session->data['cart'])) {
			foreach($this->session->data['cart'] as $recipe_id => $value) {
				$recipe = $recipeModel->getRecipe($recipe_id);
				$recipe['remove'] = $this->url->buildUrl('public/shoppinglist/remove/' . $recipe_id);

				$data['recipes'][] = $recipe;
			}
		}

		$this->view('common/header', $data);

		$this->view('shoppinglist/list', $data);

		$this->view('common/footer');
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

	public function remove($id)
	{
		if(isset($this->session->data['cart'][$id])) {
			$recipeModel = $this->model('Recipe');

			$recipe = $recipeModel->getRecipe($id);

			unset($this->session->data['cart'][$id]);

			$this->session->data['success_message'] = sprintf('You have successfully removed %s from shopping list!', $recipe['name']);

			$this->response->redirect($this->url->buildUrl('public/shoppinglist'));
		} else {
			$this->response->redirect($this->url->buildUrl('public/shoppinglist'));
		} 
	}

	public function getStylesheets()
	{
		$stylesheets = $this->assets->getStylesheets();
		foreach ($stylesheets as $key => $value) {
			$stylesheets[$key] = $this->url->buildUrl($value);
		}

		return $stylesheets;
	}
}