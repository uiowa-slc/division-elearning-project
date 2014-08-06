<?php
class ElearningCoursePage extends Page {

	private static $db = array(
		'ExplanatoryText' => 'HTMLText'
	);

	private static $has_one = array(
		'AudioClip' => 'File',
	);
	private static $can_be_root = false;
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

	public function CompletionStatus(){
		$courseStatus = Session::get('courseStatus');
		$currentCourse = $this->Course();
		//print_r('completion status of this page: '.$courseStatus[$currentCourse->ID][$this->ID]);
		if(isset($courseStatus[$currentCourse->ID][$this->ID])){
			return $courseStatus[$currentCourse->ID][$this->ID];
		}else{
			return false;
		}
	}

	public function NextLink(){
		return $this->Link().'Next/';
	}


	/*public function Course(){
		$pageTemp = $this;
		while($pageTemp->ClassName != 'ElearningCourseHome'){
			$pageTemp = $this->getParent();
		}
		return $pageTemp;
	}*/

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
		'disableAudioInSession',
		'enableAudioInSession',
		'Next',
		'Clear',
	);

	private static $url_handlers = array (
		'disableAudioInSession' => 'disableAudioInSession',
		'enableAudioInSession' => 'enableAudioInSession',
		'Next' => 'Next',
		'Clear' => 'Clear'
	);

	public function init() {

		$sessionCourseData = Session::get('courseStatus');

		if(!isset($sessionCourseData[$this->Course()->ID]['started'])){
			$courseStatus[$this->Course()->ID]['started'] = 'true';
			Session::set('courseStatus', $courseStatus);
			Session::save();
		}
		//print_r($sessionCourseData);
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

	public function disableAudioInSession(){
		Session::set('Audio', 'Disabled');
		Session::save();
		$this->redirectBack();
	}
	public function enableAudioInSession(){
		Session::set('Audio', 'Enabled');
		Session::save();
		$this->redirectBack();
	}

	public function IsAudioEnabled(){
		$audioStatus = Session::get('Audio');
		if($audioStatus == 'Disabled'){
			return false;
		}else{
			return true;
		}
	}	
	public function getPaginatedPages( $relation ) {
		$list = new PaginatedList( $this->$relation(), $this->request );
		$list->setPageLength( 1 );
		return $list;
	}

	public function NextPage(){
		$nextPage = $this->getNextPage();
		if(isset($nextPage)){
			$data = array(
				'Title' => $nextPage->Title,
				'Link' => $this->Link().'Next/'
			);
		
			return $this->customise($data);
		}

	}

	public function Next(){

		$courseStatus = Session::get('courseStatus');
		$currentCourse = $this->Course();

		$nextPage = $this->getNextPage();
		$courseStatus[$currentCourse->ID][$this->ID] = 'completed';
		Session::set('courseStatus', $courseStatus);
		Session::save();

		if(isset($nextPage)){
			//Make Next Page available if it isn't completed already.
			if($courseStatus[$currentCourse->ID][$nextPage->ID] != 'completed'){
				$courseStatus[$currentCourse->ID][$nextPage->ID] = 'available';
				Session::set('courseStatus', $courseStatus);
				Session::save();
			}

			$this->redirect($nextPage->Link());
		}

	}



	public function Clear(){
		if(Director::isDev()){
			Session::clear_all();
			$this->redirectBack();
		}
	}

	public function isDev(){
		return Director::isDev();
	}



}
