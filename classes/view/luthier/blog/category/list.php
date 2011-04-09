<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article category list view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Category_List extends View_Luthier_Table {

	protected $_sub_layout = 'wide';

	public $header = 'Article Categories';

	public $things = 'categories';

	/**
	 * Generate the URL for the create action
	 */
	public function create_url()
	{
		return Route::get('luthier')->uri(array(
			'directory'  => 'blog',
			'controller' => 'category',
			'action'     => 'create',
		));
	}

	/**
	 * Setup the columns for the category list
	 */
	public function columns()
	{
		return array(
			array('title' => 'ID'),
			array('title' => 'Name'),
			array('title' => 'Actions'),
			array('title' => ''),
		);
	}

	/**
	 * Setup the rows for the category list
	 */
	public function rows()
	{
		// Setup rows array
		$rows = array();

		// Create base URLs for the edit/delete actions on this category
		$params = array('directory' => 'blog', 'controller' => 'category');
		$edit_url   = Route::get('luthier')->uri($params + array('action' => 'edit'));
		$delete_url = Route::get('luthier')->uri($params + array('action' => 'delete'));

		// Retrieve all categories
		$categories = Sprig::factory('blog_category')->load(NULL, FALSE);

		// Setup the row contents for each category
		foreach ($categories as $category)
		{
			// Create the HTML links for the edit/delete actions
			$edit_link   = HTML::anchor($edit_url.'?id='.$category->id,
				'Edit',   array('class' => 'edit'));
			$delete_link = HTML::anchor($delete_url.'?id='.$category->id,
				'Delete', array('class' => 'delete'));

			$rows[] = array(
				'cells' => array(
					array('contents' => $category->id),
					array('contents' => $category->name),
					array('contents' => $edit_link),
					array('contents' => $delete_link),
				),
			);
		}

		return $rows;
	}

}

