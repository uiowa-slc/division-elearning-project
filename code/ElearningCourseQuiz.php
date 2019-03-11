<?php
use SilverStripe\ORM\DataObject;
use Silverstripe\Forms\TextField;
class ElearningCourseQuiz extends ElearningCoursePage {

	private static $db = array(
		"QuizURL" => "Varchar(255)"
	);

	private static $singular_name = 'Elearning Quiz';

	private static $plural_name = 'Elearning Quizzes';

	private static $default_parent = "ElearningCourseHome";

	private static $can_be_root = false;

    public function getCMSFields() {
	    $fields = parent::getCMSFields();
	    $fields->addFieldToTab('Root.Main', new TextField('QuizURL', 'Qualatrics/Quiz URL');

	    return $fields;
	  }
	  
}