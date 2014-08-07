<?php
class ElearningCoursePart extends ElearningCoursePage {

	private static $db = array(
		
	);

	private static $has_one = array(
	);

	private static $allowed_children = array("ElearningCourseChapter", "ElearningCourseQuestion");

	private static $singular_name = 'Part';

	private static $plural_name = 'Parts';

	private static $default_parent = "ElearningCourseHome";
	private static $can_be_root = false;
	
	public function Course(){
		$pageTemp = $this;
		while($pageTemp->ClassName != 'ElearningCourseHome'){
			$pageTemp = $this->getParent();
		}
		return $pageTemp;
	}

	
	public function getNextPage() {
		//If part has children, then the next page is its first child.
		if($this->Children()->First()){
			return $this->Children()->First();
		}else{
			$page = Page::get()->filter( array (
				'ParentID' => $this->ParentID,
				'Sort:GreaterThan' => $this->Sort
			) )->First();
		}
		if(isset($page)){
			return $page;
		}
	}
	
}
class ElearningCoursePart_Controller extends ElearningCoursePage_Controller {

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
		'Next'
	);
	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}


	


	

}
