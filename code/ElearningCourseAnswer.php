<?php
class ElearningCourseAnswer extends DataObject {

	private static $db = array(
		"Answer" => "Varchar(255)",
		"TimesAnswered" => "Int",
		//"isCorrect" => "Boolean",
		"SortOrder" => "Int"
	);
	
	private static $has_one = array(
		"Question" => "ElearningCourseQuestion"
	);

	private static $summary_fields = array(
		"Answer"
	);
	private static $singular_name = 'Answer';

	private static $plural_name = 'Answers';

    public function getCMSFields() {
	    $fields = parent::getCMSFields();

	    $questionField = new ReadonlyField('QuestionLabelField', 'Question');
	    $questionField->setValue($this->Question()->Content);

	    $fields->addFieldToTab('Root.Main', $questionField);
	    $fields->removeByName("TimesAnswered");
	    $fields->removeByName("QuestionID");
	    $fields->removeByName("SortOrder");
	    return $fields;
	  }

}