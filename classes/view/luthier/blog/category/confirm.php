<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article category delete confirmation view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Category_Confirm extends View_Luthier_Confirm {

	protected $_sub_layout = 'narrow';

	public $action = 'delete';
	public $thing = 'category';
	public $note = 'All posts belonging to this category will become uncategorized.';

	/**
	 * Show the category name on the confirmation page
	 */
	public function name()
	{
		return $this->category->name;
	}

	/**
	 * Generate the header
	 */
	public function header()
	{
		return __('Delete Category :name?',
			array(':name' => $this->category->name));
	}

}
