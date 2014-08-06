<?php
class ElearningCourseHome extends ElearningCoursePage {

	private static $db = array(
		"SubHeader" => "Varchar(255)",
		"IntroductionTitle" => "Varchar(255)",
		"FooterText" => "HTMLText"
	);

	private static $has_one = array(
	);
	private static $can_be_root = true;
	private static $allowed_children = array("ElearningCoursePart");
	
	private static $singular_name = 'Elearning Course';

	private static $plural_name = 'Elearning Courses';

	public function getCMSfields() {
		$fields = parent::getCMSFields();

		$fields->removeByName("Content");

		$fields->addFieldToTab('Root.Main', new TextField('IntroductionTitle', 'Introduction Title (e.g., "Introduction")'), 'ExplanatoryText');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('FooterText', 'Footer Text (appears throughout entire course)'));		
		return $fields;
	}

	public function Course(){
		return $this;
	}

}
class ElearningCourseHome_Controller extends ElearningCoursePage_Controller {

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
	public function getNextPage() {
		return $this->Children()->First();		
	}


}
