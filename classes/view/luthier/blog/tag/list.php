<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article tag list view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Tag_List extends View_Luthier_Table {

	protected $_sub_layout = 'wide';

	public $header = 'Article Tags';

	public $things = 'tags';

	/**
	 * Generate the URL for the create action
	 */
	public function create_url()
	{
		return Route::get('luthier')->uri(array(
			'directory'  => 'blog',
			'controller' => 'tag',
			'action'     => 'create',
		));
	}

	/**
	 * Setup the columns for the tag list
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
	 * Setup the rows for the tag list
	 */
	public function rows()
	{
		// Setup rows array
		$rows = array();

		// Create base URLs for the edit/delete actions on each tag
		$params = array('directory' => 'blog', 'controller' => 'tag');
		$edit_url   = Route::get('luthier')->uri($params + array('action' => 'edit'));
		$delete_url = Route::get('luthier')->uri($params + array('action' => 'delete'));

		// Retrieve all tags
		$tags = Sprig::factory('blog_tag')->load(NULL, FALSE);

		// Setup the row contents for each tag
		foreach ($tags as $tag)
		{
			// Create the HTML links for the edit/delete actions
			$edit_link   = HTML::anchor($edit_url.'?id='.$tag->id,
				'Edit',   array('class' => 'edit'));
			$delete_link = HTML::anchor($delete_url.'?id='.$tag->id,
				'Delete', array('class' => 'delete'));

			$rows[] = array(
				'cells' => array(
					array('contents' => $tag->id),
					array('contents' => $tag->name),
					array('contents' => $edit_link),
					array('contents' => $delete_link),
				),
			);
		}

		return $rows;
	}

}

