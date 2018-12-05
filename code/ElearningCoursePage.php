<?php
class ElearningCoursePage extends Page {

	private static $db = array(
		'ExplanatoryText' => 'HTMLText'
	);

	private static $has_one = array(
		'AudioClip' => 'File'
	);
	private static $can_be_root = false;
	//private static $allowed_children = array("ElearningCourseChapter");
	
	function getCMSFields() {
		$fields = parent::getCMSfields();
		$fields->removeFieldFromTab("Root.Main", "BackgroundImage");

		$fields->addFieldToTab('Root.Main', new UploadField( 'AudioClip', 'Audio Clip'),'Content');
		$fields->addFieldToTab(
			'Root.Main',
			new HTMLEditorField( 'ExplanatoryText', 'Explanatory Text')
		);
		$fields->removeByName("Metadata");
		return $fields;
	}

	public function CompletionStatus(){
		$courseStatus = Session::get('courseStatus');
		$currentCourse = $this->Course();
		//print_r('completion status of this page: '.$courseStatus[$currentCourse->ID][$this->ID]);
		if(isset($courseStatus[$currentCourse->ID][$this->ID])){
			return $courseStatus[$currentCourse->ID][$this->ID]['status'];
		}else{
			return false;
		}
	}

	public function NextLink(){
		return $this->Link().'Next/';
	}


	public function Course(){
		$pageTemp = $this;
		if ($pageTemp->Classname == 'ElearningCourseHome') {
			$course = $this;
		} else {
			while ($pageTemp->ClassName != 'ElearningCourseHome') {
				$pageTemp = $pageTemp->getParent();
			}
		}
		return $pageTemp;
	}

}