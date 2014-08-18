<?php
class ElearningCourseQuestion extends ElearningCourseChapter {

	private static $db = array(
		'CorrectAnswerSummary' => 'HTMLText',
		'AnswerAdditionalInfo' => 'HTMLText'
	);
	
	private static $has_many = array(
		'Answers' => 'ElearningCourseAnswer'
	);

	private static $has_one = array(
		'CorrectAnswer' => 'ElearningCourseAnswer',
		'QuestionAudioClip' => 'File'
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
		$fields->removeByName('AudioClip');
		$fields->removeByName('ExplanatoryText');

		$fields->renameField("AudioClip", "Answer Explanatory Audio Clip");

		$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));

		$answerGridField = new GridField('Answers', 'The Answers', $this->Answers(), $gridFieldConfig);


		
		$correctAnswerField = new DropdownField('CorrectAnswerID', 'Correct Answer', $this->Answers()->map('ID', 'Answer'));
		
	
		$fields->addFieldToTab('Root.Main', new UploadField( 'QuestionAudioClip', 'Question Audio Clip'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Content', 'Question'));

		$fields->addFieldToTab('Root.Main', $answerGridField); // add the grid field to a tab in the CMS
		$fields->addFieldToTab('Root.Main', $correctAnswerField);
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('AnswerAdditionalInfo', 'Answer Additional Info'));
		$fields->addFieldToTab('Root.Main', new UploadField( 'AudioClip', 'Answer Explanatory Audio Clip'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('ExplanatoryText', 'Answer Explanatory Text'));	
		

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
				new OptionsetField('Question', 'The most appropriate response is:', $options, $answerPicked )
			);
			$actions = new FieldList(
				FormAction::create('doCheckAnswers')->setTitle('Check Answer')
			);
			$validator = new RequiredFields(
				"Question"
			);
			$validator->validationError('Question', 'You must choose an appropriate response before continuing.' );
			$form = new Form($this, 'ChapterQuestionForm', $fields, $actions, $validator);
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
		Session::save();
		return $this->customise($templateData);
	}	
}
