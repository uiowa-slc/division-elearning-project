<?php
use Silverstripe\Forms\HTMLEditor\HTMLEditorField;
use Silverstripe\Forms\TextField;
class ElearningCourseHome extends ElearningCoursePage {

	private static $db = array(
		"CourseHeader" => "HTMLText",
		"IntroductionTitle" => "Varchar(255)",
		"FooterText" => "HTMLText",
		'TimesCompleted' => 'Int'
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
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('CourseHeader', 'Course Header (appears on the course homepage only.'), 'ExplanatoryText');
		$fields->addFieldToTab('Root.Main', new TextField('IntroductionTitle', 'Introduction Title (e.g., "Introduction")'), 'CourseHeader');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('FooterText', 'Footer Text (appears throughout entire course)'));		
		return $fields;
	}

	public function Course(){
		return $this;
	}

}
