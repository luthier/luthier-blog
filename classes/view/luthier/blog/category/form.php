<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article category edit view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Category_Form extends View_Luthier_Form {

	protected $_sub_layout = 'narrow';

	/**
	 * @var Sprig The article category model being modified
	 */
	public $category;

	/**
	 * Display appropriate header depending on whether
	 * the category exists already or not
	 */
	public function header()
	{
		return $this->category->loaded()
			//? __('Modifying :name', array(':name' => $this->category->name))
			? __('Modify Category')
			: __('Create New Category');
	}

	/**
	 * Setup the fields for the article category form
	 */
	public function fields()
	{
		return array(
			array(
				'error' => Arr::get($this->errors, 'name', FALSE),
				'field' => 'name',
				'label' => 'Name',
				'input' => Form::input('name', $this->category->name),
			),
		);
	}

	/**
	 * Display appropriate submit text depending on whether
	 * the category exists already or not
	 */
	public function submit()
	{
		return $this->category->loaded()
			? __('Save')
			: __('Create');
	}

}
