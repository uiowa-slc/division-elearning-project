<?php
class ElearningCourseAnswer extends DataObject {

	private static $db = array(
		"Answer" => "Varchar(255)",
		"TimesAnswered" => "Int",
		"PercentAnswered" => "Percentage",
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
	  
	public function percentAnswered() {
		$question = $this->Question();
		$answers = $question->Answers();
		$answerCount = $answers->Count();
		$totalTimesAnswered = 0;
		
		foreach ($answers as $answer) {
			$timesAnswered = $answer->TimesAnswered;
			$totalTimesAnswered += $timesAnswered;
		}
		
		$thisTimesAnswered = $this->TimesAnswered;

		if($thisTimesAnswered != 0){
			$percentAnswered = $thisTimesAnswered/$totalTimesAnswered;
			$this->PercentAnswered = $percentAnswered;
		}else{
			$this->PercentAnswered = 0;
		}

		return $this->PercentAnswered;	

	}
}