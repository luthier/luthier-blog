<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article editor view
 *
 * @package     Luthier/Blog
 * @category    View
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class View_Luthier_Blog_Article_Form extends View_Luthier_Editor {

	/**
	 * @var Model_Blog_Article The blog article being edited
	 */
	public $article;

	/**
	 * Setup the fields for blog article editor
	 */
	public function fields()
	{
		$title    = $this->article->field('title');
		$slug     = $this->article->field('slug');
		$text     = $this->article->field('text');
		$state    = $this->article->field('state');
		$category = $this->article->field('category');
		$tags     = $this->article->field('tags');
		$comment  = $this->article->field('comment');

		return array(
			array(
				'error' => isset($this->errors['title'])
					? $this->errors['title'] : FALSE,
				'field' => 'title',
				'label' => $title->label,
				'input' => $this->article->input('title'),
			),
			array(
				'error' => isset($this->errors['slug'])
					? $this->errors['title'] : FALSE,
				'field' => 'slug',
				'label' => $slug->label,
				'input' => $this->article->input('slug'),
			),
			array(
				'error' => isset($this->errors['text'])
					? $this->errors['title'] : FALSE,
				'field' => 'text',
				'label' => $text->label,
				'input' => $this->article->input('text'),
			),
			array(
				'error' => isset($this->errors['state'])
					? $this->errors['title'] : FALSE,
				'field' => 'state',
				'label' => $state->label,
				'input' => $this->article->input('state'),
			),
			array(
				'error' => isset($this->errors['category'])
					? $this->errors['title'] : FALSE,
				'field' => 'category',
				'label' => $category->label,
				'input' => $this->article->input('category'),
			),
			array(
				'error' => isset($this->errors['tags'])
					? $this->errors['title'] : FALSE,
				'field' => 'tags',
				'label' => $tags->label,
				'input' => $this->article->input('tags'),
			),
			array(
				'error' => isset($this->errors['comment'])
					? $this->errors['title'] : FALSE,
				'field' => 'comment',
				'label' => $comment->label,
				'input' => $this->article->input('comment'),
			),
		);
	}

	/**
	 * Display 'Save' if modifying an existing article
	 * else display 'Create'
	 */
	public function submit()
	{
		return $this->article->loaded()
			? 'Save'
			: 'Create';
	}

}
