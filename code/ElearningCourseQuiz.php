<?php
use SilverStripe\ORM\DataObject;
use Silverstripe\Forms\TextField;
class ElearningCourseQuiz extends ElearningCoursePage {

	private static $db = array(
		'QuizURL' => "Varchar(255)"
	);

	private static $singular_name = 'Elearning Quiz';

	private static $plural_name = 'Elearning Quizzes';

	private static $default_parent = "ElearningCoursePart";

	private static $can_be_root = false;

    public function getCMSFields() {
	    $fields = parent::getCMSFields();
	    $fields->addFieldToTab('Root.Main', new TextField('QuizURL', 'Qualatrics/Quiz URL'), 'QuizURL');

	    return $fields;
	}

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