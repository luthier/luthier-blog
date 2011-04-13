<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article tag edit view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Tag_Form extends View_Luthier_Form {

	protected $_sub_layout = 'narrow';

	/**
	 * @var Sprig The article tag model being modified
	 */
	public $tag;

	/**
	 * Display appropriate header depending on whether
	 * the tag exists already or not
	 */
	public function header()
	{
		return $this->tag->loaded()
			//? __('Modifying :name', array(':name' => $this->tag->name))
			? __('Modify Tag')
			: __('Create New Tag');
	}

	/**
	 * Setup the fields for the article tag form
	 */
	public function fields()
	{
		return array(
			array(
				'error' => Arr::get($this->errors, 'name', FALSE),
				'field' => 'name',
				'label' => 'Name',
				'input' => Form::input('name', $this->tag->name),
			),
		);
	}

	/**
	 * Display appropriate submit text depending on whether
	 * the tag exists already or not
	 */
	public function submit()
	{
		return $this->tag->loaded()
			? __('Save')
			: __('Create');
	}

}
