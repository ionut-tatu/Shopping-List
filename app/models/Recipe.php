<?php

class Recipe extends Controller 
{
	
	/**
	 *	Retrive all recipes from database. 
	 *
	 *	@return array/bool
	 */
	public function getRecipes()
	{
		$sql = "SELECT id, name, description, image FROM recipes";

		$results = $this->db->query($sql);

		if($results->rows) {
			return $results->rows;
		}

		return false;
	}

	/**
	 *	Retrive recipe from database based on recipe id. 
	 *
	 *	@param int $id
	 *	@return array/bool
	 */
	public function getRecipe($id) 
	{
		if(!$id) {
			return false;
		}

		$sql = "SELECT id, name, description, image, ingredientes FROM recipes WHERE id = $id";

		$results = $this->db->query($sql);

		if($results->rows) {
			return [
				'id' => $results->row['id'],
				'name' => $results->row['name'],
				'description' => $results->row['description'],
				'image' => $this->url->buildUrl('public/css/images/recipes/' . $results->row['image']),
				'ingredientes' => $results->row['ingredientes'],
				'nextRecipe' => $this->getNextId($results->row['id']),
				'previousRecipe' => $this->getPreviousId($results->row['id'])
			];
		}

		return false;
	}


	/**
	 *	@todo: Rewrite functions. 
	 */
	private function getNextId($id)
	{
		$sql = "SELECT id FROM recipes WHERE id > $id ORDER BY id ASC LIMIT 1";

		$result = $this->db->query($sql);

		if($result->rows) {
			return $result->row['id'];
		}

		return $this->getFirstId();
	}

	private function getFirstId()
	{
		$sql = "SELECT id FROM recipes ORDER BY id ASC LIMIT 1";

		$result = $this->db->query($sql);

		if($result->rows) {
			return $result->row['id'];
		}

		return false;
	}

	private function getPreviousId($id)
	{
		$sql = "SELECT id FROM recipes WHERE id < $id ORDER BY id DESC LIMIT 1";

		$result = $this->db->query($sql);

		if($result->rows) {
			return $result->row['id'];
		}

		return $this->getLastId();
	}

	private function getLastId()
	{
		$sql = "SELECT id FROM recipes ORDER BY id DESC LIMIT 1";

		$result = $this->db->query($sql);

		if($result->rows) {
			return $result->row['id'];
		}

		return false;
	}
}