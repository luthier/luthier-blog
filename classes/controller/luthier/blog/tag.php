<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article tag management controller
 *
 * @package     Luthier/Blog
 * @category    Controller
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class Controller_Luthier_Blog_Tag extends Controller {

	/** The URL for the tag management index */
	protected $_index;

	/** The response view */
	protected $_view;

	/**
	 * Save the URL to the tag management index
	 */
	public function before()
	{
		parent::before();
		$this->_index = Route::get('luthier')->uri(array(
			'directory'  => 'blog',
			'controller' => 'tag',
		));
	}

	/**
	 * Add section navigation to all views and set as the response
	 */
	public function after()
	{
		if ($this->_view !== NULL)
		{
			$this->_view->_add_section_nav('Create Tag', Route::get('luthier')->uri(array(
				'directory'  => 'blog',
				'controller' => 'tag',
				'action'     => 'create',
			)), 'Tags');

			$this->response->body($this->_view);
		}
	}

	/**
	 * Display all tag
	 */
	public function action_index()
	{
		$this->_view = new View_Luthier_Blog_Tag_List;
	}

	/**
	 * Create a new tag
	 */
	public function action_create()
	{
		$this->_view = new View_Luthier_Blog_Tag_Form;
		$this->_view->bind('tag', $tag)
			->bind('errors', $errors);

		$tag = Model_Blog_Tag::factory();

		if ($_POST)
		{
			$tag->values($_POST);

			try
			{
				$tag->create();
				$msg = __('The tag, :name, has been created',
					array(':name' => $tag->name));
				Luthier::message($msg);
				$this->request->redirect($this->_index);
			}
			catch (Validation_Exception $e)
			{
				$errors = $e->array->errors('blog');
			}
		}
	}

	/**
	 * Modify an existing tag
	 */
	public function action_edit()
	{
		$this->_view = new View_Luthier_Blog_Tag_Form;
		$this->_view->bind('tag', $tag)
			->bind('errors', $errors);

		$id = Arr::get($_GET, 'id');
		$tag = Model_Blog_Tag::factory(array('id' => $id))
			->load();

		if ($_POST)
		{
			$tag->values($_POST);

			try
			{
				$tag->update();
				$msg = __('The tag, :name, has been updated',
					array(':name' => $tag->name));
				Luthier::message($msg);
				$this->request->redirect($this->_index);
			}
			catch (Validation_Exception $e)
			{
				$errors = $e->array->errors('blog');
			}
		}
	}

	/**
	 * Delete a tag
	 */
	public function action_delete()
	{
		// If deletion is not desired, redirect to list
		if (isset($_POST['no']))
			$this->request->redirect($this->_index);

		$this->_view = new View_Luthier_Blog_Tag_Confirm;
		$this->_view->bind('tag', $tag);

		$id = Arr::get($_GET, 'id');
		$tag = Model_Blog_Tag::factory(array('id' => $id))
			->load();

		// If deletion is confirmed
		if (isset($_POST['yes']))
		{
			try
			{
				$tag->delete();
				$msg = __('The tag, :name, has been deleted',
					array(':name' => $tag->name));
				Luthier::message($msg);
				$this->request->redirect($this->_index);
			}
			catch (Exception $e)
			{
				Kohana::$log->add(Log::ERROR, 'Error occured deleting tag, id='.$tag->id.', '.$e->getMessage());
				$msg = __('An error occured deleting tag, :name',
					array(':name' => $tag->name));
				$this->request->redirect($this->_index);
			}
		}
	}

}
