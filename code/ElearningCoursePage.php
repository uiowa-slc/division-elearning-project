<?php
use Silverstripe\Assets\File;
use Silverstripe\Control\Session;
use Silverstripe\AssetAdmin\Forms\UploadField;
use Silverstripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;

class ElearningCoursePage extends Page {

	private static $db = array(
		'ExplanatoryText' => 'HTMLText'
	);

	private static $has_one = array(
		'AudioClip' => File::class,
	);

	private static $owns = array(
		'AudioClip'
	);

	private static $can_be_root = false;
	//private static $allowed_children = array("ElearningCourseChapter");
	
	function getCMSFields() {
		$fields = parent::getCMSfields();
		$fields->removeFieldFromTab("Root.Main", "BackgroundImage");

		$fields->addFieldToTab('Root.Main', new UploadField( 'AudioClip', 'Audio Narration'),'Content');
		$fields->addFieldToTab(
			'Root.Main',
			new HTMLEditorField( 'ExplanatoryText', 'Explanatory Text (shows up below the main content')
		);

		$fields->renameField('Content', 'Main Content Area');
		$fields->removeByName("Metadata");
		$fields->removeByName("LayoutType");
		$fields->removeByName("YoutubeBackgroundEmbed");

		return $fields;
	}

	public function NextLink(){
		if($this->isPublished()){
			return $this->RelativeLink(false).'Next/';
		}else{
			return $this->RelativeLink(false).'Next/?stage=Stage';
		}
		
	}

	public function CompletionStatus(){

		$request = Injector::inst()->get(HTTPRequest::class);
		$session = $request->getSession();
		$courseStatus = $session->get('courseStatus');
		$currentCourse = $this->Course();
		// print_r('completion status of this page: '.$courseStatus[$currentCourse->ID][$this->ID]);
		if(isset($courseStatus[$currentCourse->ID][$this->ID])){
			return $courseStatus[$currentCourse->ID][$this->ID]['status'];
		}else{
			return false;
		}
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