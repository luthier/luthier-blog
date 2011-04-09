<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article category management controller
 *
 * @package     Luthier/Blog
 * @category    Controller
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class Controller_Luthier_Blog_Category extends Controller {

	/** The URL for the category management index */
	protected $_index;

	/** The response view */
	protected $_view;

	/**
	 * Save the URL to the category management index
	 */
	public function before()
	{
		parent::before();
		$this->_index = Route::get('luthier')->uri(array(
			'directory'  => 'blog',
			'controller' => 'category',
		));
	}

	/**
	 * Add section navigation to all views and set as the response
	 */
	public function after()
	{
		if ($this->_view !== NULL)
		{
			$this->_view->_add_section_nav('Create Category', Route::get('luthier')->uri(array(
				'directory'  => 'blog',
				'controller' => 'category',
				'action'     => 'create',
			)), 'Categories');

			$this->response->body($this->_view);
		}
	}

	/**
	 * Display all category
	 */
	public function action_index()
	{
		$this->_view = new View_Luthier_Blog_Category_List;
	}

	/**
	 * Create a new category
	 */
	public function action_create()
	{
		$this->_view = new View_Luthier_Blog_Category_Form;
		$this->_view->bind('category', $category)
			->bind('errors', $errors);

		//$category = new Model_Blog_Category;
		$category = Model_Blog_Category::factory();

		if ($_POST)
		{
			$category->values($_POST);

			try
			{
				$category->create();
				$msg = __('The category, :name, has been created',
					array(':name' => $category->name));
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
	 * Modify an existing category
	 */
	public function action_edit()
	{
		$this->_view = new View_Luthier_Blog_Category_Form;
		$this->_view->bind('category', $category)
			->bind('errors', $errors);

		$id = Arr::get($_GET, 'id');
		$category = Model_Blog_Category::factory(array('id' => $id))
			->load();

		if ($_POST)
		{
			$category->values($_POST);

			try
			{
				$category->update();
				$msg = __('The category, :name, has been updated',
					array(':name' => $category->name));
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
	 * Delete a category
	 */
	public function action_delete()
	{
		// If deletion is not desired, redirect to list
		if (isset($_POST['no']))
			$this->request->redirect($this->_index);

		$this->_view = new View_Luthier_Blog_Category_Confirm;
		$this->_view->bind('category', $category);

		//$name = $category->name;

		$id = Arr::get($_GET, 'id');
		$category = Model_Blog_Category::factory(array('id' => $id))
			->load();

		// If deletion is confirmed
		if (isset($_POST['yes']))
		{
			try
			{
				$category->delete();
				$msg = __('The category, :name, has been deleted',
					array(':name' => $category->name));
				Luthier::message($msg);
				$this->request->redirect($this->_index);
			}
			catch (Exception $e)
			{
				Kohana::$log->add(Log::ERROR, 'Error occured deleting category, id='.$category->id.', '.$e->getMessage());
				$msg = __('An error occured deleting category, :name',
					array(':name' => $category->name));
				$this->request->redirect($this->_index);
			}
		}
	}

}
