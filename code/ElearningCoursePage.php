<?php
class ElearningCoursePage extends Page {

	private static $db = array(
		'ExplanatoryText' => 'HTMLText'
	);

	private static $has_one = array(
		'AudioClip' => 'File',
	);

	//private static $allowed_children = array("ElearningCourseChapter");
	
	function getCMSFields() {
		$fields = parent::getCMSfields();
		$fields->removeFieldFromTab("Root.Main", "BackgroundImage");

		$fields->addFieldToTab(
			'Root.Main',
			 new UploadField( 'AudioClip', 'Audio Clip'),
			 'Content'
		);
		$fields->addFieldToTab(
			'Root.Main',
			new HTMLEditorField( 'ExplanatoryText', 'Explanatory Text')
		);

		return $fields;
	}

}
class ElearningCoursePage_Controller extends Page_Controller {

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
	
	
	public function getPaginatedPages( $relation ) {
		$list = new PaginatedList( $this->$relation(), $this->request );
		$list->setPageLength( 1 );
		return $list;
	}

}
