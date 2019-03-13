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
		return $this->getParent()->Parent;
	}

	
	public function getNextPage() {
		//Find a page on the same level as the current chapter with a higher sort order, if there is a page, return it.
		$page = Page::get()->filter( array (
				'ParentID' => $this->ParentID,
				'Sort:GreaterThan' => $this->Sort
			) )->First();
		if(isset($page)){

			return $page;

		//If there's not a page on the same level with a higher sort order, look at the parent's level (part) and find the next part.
		}else{
			$parent = $this->getParent();
			if(isset($parent)){
				$page = Page::get()->filter( array (
					'ParentID' => $parent->ParentID,
					'Sort:GreaterThanOrEqual' => $parent->Sort,
				) )->exclude(array('ID' => $parent->ID))->First();	
				return $page;			
			}
		}
	}
	  
}