<?php
/**
 *	Recipe Class.
 *	@todo: refactor common urls and stylesheets. Move them up one level.
 */

class RecipeController extends Controller {
	private $current_location = 'recipe';
 	
 	/**
	 *	Get all recipes.
	 *	
	 *	@return View
	 */
	public function index()
	{
		$data['recipeUrl'] = $this->url->buildUrl('public/recipe');
		$data['shoppingListUrl'] = $this->url->buildUrl('public/shoppinglist');
		$data['current_location'] = $this->current_location;

		$data['stylesheets'] = $this->getStylesheets();

		// Get Recipes
		$recipe = $this->model('Recipe');
		
		$results = $recipe->getRecipes();

		$data['recipes'] = [];
		if($results) {
			foreach ($results as $key => $value) {
				$data['recipes'][] = [
					'id' => $value['id'],
					'name' => $value['name'],
					'description' => substr($value['description'], 0, 100),
					'image' => $this->url->buildUrl('public/css/images/recipes/' . $value['image']),
					'href' => $this->url->buildUrl('public/recipe/show/' . $value['id'])
				];
			}
		}

		$this->view('common/header', $data);

		$this->view('recipe/list', $data);

		$this->view('common/footer');
	}

	/**
	 *	Show specific recipe.
	 *	
	 *	@param int $id
	 *	@return View/Response
	 */
	public function show($id) 
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

		$recipe = $this->model('Recipe');

		$results = $recipe->getRecipe($id);

		if($results) {
			$data['recipe'] = [
				'id' => $results['id'],
				'name' => $results['name'],
				'description' => $results['description'],
				'image' => $results['image'],
				'ingredientes' => $results['ingredientes'],
				'backUrl' => $this->url->buildUrl('public/recipe'),
				'addToCartUrl' => $this->url->buildUrl('public/shoppinglist/add/' . $results['id']),
				'nextRecipe' => $results['nextRecipe'],
				'previousRecipe' => $results['previousRecipe']
			];

			$this->view('common/header', $data);

			$this->view('recipe/show', $data);

			$this->view('common/footer');

		} else {
			// Redirect back to list if no recipe found.
			$this->response->redirect($this->url->buildUrl('public/recipe'));
		}
	}

	/**
	 *	@todo: Move this.
	 */
	public function getStylesheets()
	{
		$stylesheets = $this->assets->getStylesheets();
		foreach ($stylesheets as $key => $value) {
			$stylesheets[$key] = $this->url->buildUrl($value);
		}

		return $stylesheets;
	}
}