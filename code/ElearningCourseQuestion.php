<?php
use Silverstripe\Assets\File;

class ElearningCourseQuestion extends ElearningCourseChapter {

	private static $db = array(
		'CorrectAnswerSummary' => 'HTMLText',
		'AnswerAdditionalInfo' => 'HTMLText',
		'AssociatedCourse' => 'Int'
	);
	
	private static $has_many = array(
		'Answers' => 'ElearningCourseAnswer'
	);

	private static $has_one = array(
		'CorrectAnswer' => 'ElearningCourseAnswer',
		'QuestionAudioClip' => File::class
	);

	private static $singular_name = 'Question';
	private static $plural_name = 'Questions';
	private static $can_be_root = false;
	
	protected function onBeforeWrite() {
		$AssociatedCourse = $this->AssociatedCourse;
		if (empty($AssociatedCourse)) {
			$this->AssociatedCourse = $this->Course()->ID;			
		}
		parent::onBeforeWrite();
	}
	
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
