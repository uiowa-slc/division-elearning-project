<?php
class ElearningCoursePage extends Page {

	private static $db = array(
		'ExplanatoryText' => 'HTMLText'
	);

	private static $has_one = array(
		'AudioClip' => 'File'
	);
	private static $can_be_root = false;
	//private static $allowed_children = array("ElearningCourseChapter");
	
	function getCMSFields() {
		$fields = parent::getCMSfields();
		$fields->removeFieldFromTab("Root.Main", "BackgroundImage");

		$fields->addFieldToTab('Root.Main', new UploadField( 'AudioClip', 'Audio Clip'),'Content');
		$fields->addFieldToTab(
			'Root.Main',
			new HTMLEditorField( 'ExplanatoryText', 'Explanatory Text')
		);
		$fields->removeByName("Metadata");
		return $fields;
	}

	public function CompletionStatus(){
		$courseStatus = Session::get('courseStatus');
		$currentCourse = $this->Course();
		//print_r('completion status of this page: '.$courseStatus[$currentCourse->ID][$this->ID]);
		if(isset($courseStatus[$currentCourse->ID][$this->ID])){
			return $courseStatus[$currentCourse->ID][$this->ID]['status'];
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
		'Clear'
	);

	private static $url_handlers = array (
		'disableAudioInSession' => 'disableAudioInSession',
		'enableAudioInSession' => 'enableAudioInSession',
		'Next' => 'Next',
		'Clear' => 'Clear'
	);
	
	
	//recursive, yay! useful function for searching multidimensional arrays. Should it go elsewhere?
	public function array_find($needle, array $haystack) {
		
	    foreach ($haystack as $key => $value) {
	        if (is_array($value)) {
	            return $this->array_find($needle, $value);
	        } else if ($value == $needle) {
	            return $key;
	        }
	    }
	    return false;
	}
	
	public function init() {

		$courseStatus = Session::get('courseStatus');
		$currentCourse = $this->Course();

		//If there's no courseStatus session variable, assume we haven't started the course and make the course homepage "available"
		if(!isset($courseStatus[$currentCourse->ID])){
			$courseStatus[$currentCourse->ID][$currentCourse->ID]['status'] = 'available';
			Session::set('courseStatus', $courseStatus);
			Session::save();
		}
		
		//If there's no status set for the page the user's currently on, find the first page marked as available and redirect them there.
		if (!isset($courseStatus[$currentCourse->ID][$this->ID]['status'])) {
				end($courseStatus[$currentCourse->ID]);
				$returnKey = key($courseStatus[$currentCourse->ID]);
				//print_r ($returnKey);
				if (isset($courseStatus[$currentCourse->ID][$returnKey]['status'])) {
					if ($courseStatus[$currentCourse->ID][$returnKey]['status'] !== "available") {
						$returnKey = $currentCourse->ID;
					}
				}
				
				$goToPage = DataObject::get_by_id('Page', $returnKey);
				$this->redirect($goToPage->Link());	
		}
				
		//print_r($courseStatus);
		parent::init();
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
		
		//update page to be 'completed'		
		$courseStatus[$currentCourse->ID][$this->ID]['status'] = 'completed';
		
		//make next page 'available' if it is currently null or !completed
		if(isset($nextPage)){
			if(!isset($courseStatus[$currentCourse->ID][$nextPage->ID]['status'])){
				//can we put this array pointer into a more concise varible?
				$courseStatus[$currentCourse->ID][$nextPage->ID]['status'] = 'available';
			}elseif($courseStatus[$currentCourse->ID][$nextPage->ID]['status'] != 'completed'){
				$courseStatus[$currentCourse->ID][$nextPage->ID]['status'] = 'available';
			}
		}
		
		//determines if there's page after next. If not, marks current page as completed and user is done with the course.
		$pageAfterNext = $nextPage->getNextPage();
		if (!isset($pageAfterNext)) {
			$courseStatus[$currentCourse->ID][$nextPage->ID]['status'] = 'completed';

			//Increment the "times completed" variable. We need a better way to do this.
			$currentCourse->TimesCompleted = $currentCourse->TimesCompleted + 1;
			$currentCourse->write();
			$currentCourse->doPublish();
		}
		
		//If the next page in sequence is a part, we can mark the current Part as completed.
		if(($this->ClassName == 'ElearningCoursePart') && ($nextPage->ClassName == 'ElearningCourseChapter')){
			$courseStatus[$currentCourse->ID][$this->getParent()->ID]['status'] = 'completed';
		}
				
		Session::set('courseStatus', $courseStatus);
		Session::save();
		$this->redirect($nextPage->Link());
		
	}

	public function Clear(){
		Session::clear("courseStatus");
		$this->redirectBack();
	}

}
