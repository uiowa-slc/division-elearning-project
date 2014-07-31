<?php
class ElearningCourseChapter extends ElearningCoursePage {

	private static $db = array(
	);
	
	private $has_many = array(
		'Images' => 'Image',
		'Sounds' => 'File'
	);

	private static $has_one = array(
	);

	function getCMSFields() {
		$fields = parent::getCMSfields();
		
		$fields->addFieldToTab(
			'Root.Main',
			$uploadField = new UploadField(
				$name = 'Images',
				$title = 'Upload one or more images for this chapter (max 10)'
			)		
		);
			
		);
		$uploadField->setAllowedMaxFileNumber(10);
		
		return $fields;
	}
	
}
class ElearningCourseChapter_Controller extends ElearningCoursePage_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

}

