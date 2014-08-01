<?php
class ElearningCourseAnswer extends DataObject {

	private static $db = array(
		"Answer" => "Varchar(255)",
		"TimesAnswered" => "Int"
	);
	
	private static $has_one = array(
		"Question" => "ElearningCourseQuestion"
	);
	
	public function updateCMSfield() {
		//make TimesAnswered uneditable
	}
	
	
}