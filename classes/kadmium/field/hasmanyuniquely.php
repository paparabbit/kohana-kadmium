<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kadmium_Field_HasManyUniquely extends Jelly_Field_HasMany
{

	var $show_in_list = FALSE;

	public function input($prefix = 'jelly/field', $data = array())
	{
		/*
		$data['ids'] = array();
		// Grab the IDS
		foreach ($data['value'] as $model)
		{
			$data['ids'][] = $model->id();
		}
		*/
		return parent::input($prefix, $data);
	}

	public function delete($model)
	{
		if ($model->delete_policy == Kadmium_Model_Core::DELETE_ALL_CHILDREN) {
			$items = $model->get($this->name, FALSE)->execute();
			foreach($items as $item) {
				$item->delete();
			}
		}
	}
}