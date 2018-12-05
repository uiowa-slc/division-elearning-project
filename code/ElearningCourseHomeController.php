<?php

class ElearningCourseHomeController extends ElearningCoursePageController {

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
		"stats" => 'ADMIN'
	);

	private static $url_handlers = array (
		'stats' => 'stats'
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}
	public function getNextPage() {
		return $this->Children()->First();		
	}
	
	public function stats(){
		$course = $this->CourseHeader;
		
		$Questions = ElearningCourseQuestion::get()->filter(array(
			'AssociatedCourse' => $this->ID
		));
		
		$Data = array(
			'Title' => 'Course Statistics',
			'Questions' => $Questions,
			'TimesCompleted' => $this->TimesCompleted
		);
		
		return $this->Customise($Data)->renderWith(array('ElearningCourseHome_stats', 'Page'));
	}
	
	
}