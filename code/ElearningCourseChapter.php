<?php
class ElearningCourseChapter extends ElearningCoursePage {

	private static $db = array(

	);
	
	private static $has_many = array(
	);

	private static $has_one = array(
		
		'Images' => 'Image'
	);

	private static $singular_name = 'Chapter';

	private static $plural_name = 'Chapters';

	public function Course(){
		return $this->getParent()->Parent;
	}

	public function getCMSFields() {
		$fields = parent::getCMSfields();
		
		$fields->addFieldToTab(
			'Root.Main',
			 new UploadField( 'Images', 'Upload Image for this Chapter (optional)'),
			 'Content'
		);
	
				
		return $fields;
	}
	
}
class ElearningCourseChapter_Controller extends ElearningCoursePage_Controller {

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
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

	public function getNextPage() {
		$page = Page::get()->filter( array (
				'ParentID' => $this->ParentID,
				'Sort:GreaterThan' => $this->Sort
			) )->First();

		if(isset($page)){
			return $page;
		}else{
			$parent = $this->getParent();
			if(isset($parent)){
				$page = Page::get()->filter( array (
					'ParentID' => $parent->ParentID,
					'Sort:GreaterThan' => $this->Sort
				) )->First();	
				return $page;			
			}
		}
	}

}

