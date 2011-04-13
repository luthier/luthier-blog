<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article tag delete confirmation view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Tag_Confirm extends View_Luthier_Confirm {

	protected $_sub_layout = 'narrow';

	public $action = 'delete';
	public $thing = 'tag';
	public $note = 'This tag will be removed from all posts containing this tag.';

	/**
	 * Show the tag name on the confirmation page
	 */
	public function name()
	{
		return $this->tag->name;
	}

	/**
	 * Generate the header
	 */
	public function header()
	{
		return __('Delete Tag :name?',
			array(':name' => $this->tag->name));
	}

}
