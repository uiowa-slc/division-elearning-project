<?php
class ElearningCourseQuestion extends ElearningCourseChapter {

	private static $db = array(
		'CorrectAnswerSummary' => 'HTMLText'
	);
	
	private static $has_many = array(
		'Answers' => 'ElearningCourseAnswer'
	);

	private static $has_one = array(
		'CorrectAnswer' => 'ElearningCourseAnswer'
	);

	private static $singular_name = 'Question';
	private static $plural_name = 'Questions';
	private static $can_be_root = false;
	
	public function getCMSFields() {
		$fields = parent::getCMSfields();
		
		//$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		/*
		$row = 'SortOrder';
		$gridFieldConfig->addComponent($sort = new GridFieldSortableRows(stripslashes($row))); 

		$sort->table = 'Page_SidebarItems'; 
		$sort->parentField = 'PageID'; 
		$sort->componentField = 'SidebarItemID'; 
		*/
		
		$fields->removeByName('Content');

		$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));

		$gridField = new GridField('Answers', 'The Answers', $this->Answers(), $gridFieldConfig);
		
		$correctAnswerField = new DropdownField('CorrectAnswerID', 'Correct Answer (May require a refresh after adding answers)', $this->Answers()->map('ID', 'Answer'));
		

		$fields->addFieldToTab('Root.Main', $gridField,'ExplanatoryText'); // add the grid field to a tab in the CMS
		$fields->addFieldToTab('Root.Main', $correctAnswerField,'ExplanatoryText');
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Content', 'Question'), 'Answers');
		

		return $fields;
	}
		
}
class ElearningCourseQuestion_Controller extends ElearningCourseChapter_Controller {

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

		$currentCourse = $this->Course();
		$courseStatus = Session::get('courseStatus');
		
		if (isset($courseStatus[$currentCourse->ID][$this->ID]["answerPicked"])) {
			//print_r($courseStatus[$currentCourse->ID][$this->ID]["answerPicked"]);
			$answerPicked = $courseStatus[$currentCourse->ID][$this->ID]["answerPicked"];
		} else {
			$answerPicked = null;
		}

		if ($this->Answers()->First()) {
					
			$options = $this->Answers()->map('ID', 'Answer');
								
			$fields = new FieldList(
				//new TextField('ChapterQuestion'),
				new OptionsetField('Question', 'Please choose the most appropriate response:', $options, $answerPicked )
			);
			
			$actions = new FieldList( 
				FormAction::create('doCheckAnswers')->setTitle('Check Answers'),
				new OptionsetField('Question', '', $options)
			);
			
			$actions = new FieldList(
				FormAction::create('doCheckAnswers')->setTitle('Check Answer')
			);
			
			$validator = new RequiredFields(
				"Question"
			);
				
			$form = new Form($this, 'ChapterQuestionForm', $fields, $actions, $validator);
			//$form->loadDataFrom($this->request->postVars());
			
			return $form;	
			
		}
	}
	
	public function doCheckAnswers($data, $form) {
		
		$templateData = array (
			"QuestionStatus" => null
		);
		
		//Get the current course, course status session variable, next page, and correct answer
		$currentCourse = $this->Course();
		$courseStatus = Session::get('courseStatus');
		$nextPage = $this->getNextPage();
		$correctAnswer = $this->CorrectAnswer()->ID;

		//Check to see if the user actually answered the question, if not, just set QuestionStatus to unanswered and send them back.
		if(isset($data['Question'])){
			$userAnswer = intval($data['Question']);
			
			//Mark this question as completed and add a status variable for template usage.
			$courseStatus[$currentCourse->ID][$this->ID]['status'] = 'completed';
			if($userAnswer == $correctAnswer){
				$templateData["QuestionStatus"] = "Correct";
			} else{
				$templateData["QuestionStatus"] = "Incorrect";
			}
			
			//increment timesAnswered count
			$answerPicked = DataObject::get_by_id("ElearningCourseAnswer", $userAnswer);
			$answerPicked->TimesAnswered++;
			$answerPicked->write();
			
			$courseStatus[$currentCourse->ID][$this->ID]["answerPicked"] = $answerPicked->ID;	
			
		} else{
			$templateData['QuestionStatus'] = "Unanswered";
			return $this->customise($templateData);
		}
		
		

		//Make Next Page available if it exists and isn't completed already.
		if(isset($nextPage)){

			if(!isset($courseStatus[$currentCourse->ID][$nextPage->ID]['status'])){
				$courseStatus[$currentCourse->ID][$nextPage->ID]['status'] = 'available';
			}elseif($courseStatus[$currentCourse->ID][$nextPage->ID]['status'] != 'completed'){
				$courseStatus[$currentCourse->ID][$nextPage->ID]['status'] = 'available';
			}
	
		}
		// Save the Course Status session variable.
		Session::set('courseStatus', $courseStatus);
		//echo "<br>";
		//print_r ($courseStatus[$currentCourse->ID][$this->ID]["answerPicked"]);
		Session::save();
		return $this->customise($templateData);
	}
	
}

