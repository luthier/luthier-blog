<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Blog article tag model
 *
 * @package     Luthier/Blog
 * @category    Model
 * @author      Kyle Treubig
 * @copyright   (C) 2011 Kyle Treubig
 * @license     MIT
 */
class Model_Blog_Tag extends Sprig {

	public static function factory(array $values = NULL)
	{
		return parent::factory('blog_tag', $values);
	}

	public function _init()
	{
		$this->_fields += array(
			'id' => new Sprig_Field_Auto,
			'name' => new Sprig_Field_Char,
		);
	}

}
