<?php
use SilverStripe\ORM\DataObject;

class ElearningCourseQuiz extends DataObject {

	private static $db = array(
		"QuizURL" => "Varchar(255)"
	);

	private static $singular_name = 'Quiz';

	private static $plural_name = 'Quizzes';

	private static $default_parent = "ElearningCourseHome";
	
	private static $can_be_root = false;

    public function getCMSFields() {
	    $fields = parent::getCMSFields();

	    return $fields;
	  }
	  
}