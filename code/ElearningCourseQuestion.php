<?php
class ElearningCourseQuestion extends ElearningCourseChapter {

	private static $db = array(
	);
	
	private static $has_many = array(
		"Answers" => "ElearningCourseAnswer"
	);

	private static $has_one = array(
	);

	private static $singular_name = 'Question';

	private static $plural_name = 'Questions';
	
	public function getCMSFields() {
		$fields = parent::getCMSfields();
		
		//$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		/*
		$row = "SortOrder";
		$gridFieldConfig->addComponent($sort = new GridFieldSortableRows(stripslashes($row))); 

		$sort->table = 'Page_SidebarItems'; 
		$sort->parentField = 'PageID'; 
		$sort->componentField = 'SidebarItemID'; 
		*/
		$gridField = new GridField('Answers', 'The Answers', $this->Answers(), GridFieldConfig_RelationEditor::create());
		$fields->renameField('Content', 'Question');
		$fields->addFieldToTab("Root.Main", $gridField); // add the grid field to a tab in the CMS

		return $fields;
	}
		
}
class ElearningCourseQuestion_Controller extends ElearningCoursePage_Controller {

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
		'ChapterQuestionForm'
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

	public function ChapterQuestionForm() {
		/*
		$myQuestions = array(
				$this->AnswerOne => $this->AnswerOne,
                $this->AnswerTwo => $this->AnswerTwo,
                $this->AnswerThree => $this->AnswerFour,
                $this->AnswerFour =>$this->AnswerOne,
                $this->AnswerFive=> $this->AnswerOne,
                $this->AnswerSix => $this->AnswerOne
		);
		
		foreach ($myQuestions as $question) {
			if isset($question) {
				unset($myQuestions[$question]);
			}
		}
		*/
		if ($this->Answers()->First()) {
					
			$options = $this->Answers()->map('ID', 'Answer');
								
			$fields = new FieldList(
				//new TextField('ChapterQuestion'),
				new OptionsetField("Question", "Pick The Right Answer", $options)
			);
			
			$actions = new FieldList(
				FormAction::create("doCheckAnswers")->setTitle("Check Answers")
			);
			
			$form = new Form($this, 'ChapterQuestionForm', $fields, $actions);
			//$form->loadDataFrom($this->request->postVars());
	
			return $form;	
		}
	}
	
	public function doCheckAnswers($data, $form) {
		
		return $this->render();
	}

}

