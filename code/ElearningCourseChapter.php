<?php
class ElearningCourseChapter extends ElearningCoursePage {

	private static $db = array(

	);
	
	private static $has_many = array(
	);

	private static $has_one = array(
		
		'Images' => 'Image'
	);

	private static $default_parent = "ElearningCoursePart";
	private static $allowed_children = array();

	private static $singular_name = 'Elearning Section';

	private static $plural_name = 'Elearning Sections';
	
	private static $can_be_root = false;

	public function Course(){
		return $this->getParent()->Parent;
	}

	public function getCMSFields() {
		$fields = parent::getCMSfields();
		
		/*$fields->addFieldToTab(
			'Root.Main',
			 new UploadField( 'Images', 'Upload Image for this Chapter (optional)'),
			 'Content'
		);*/
	
				
		return $fields;
	}
	public function getNextPage() {
		//Find a page on the same level as the current chapter with a higher sort order, if there is a page, return it.
		$page = Page::get()->filter( array (
				'ParentID' => $this->ParentID,
				'Sort:GreaterThan' => $this->Sort
			) )->First();
		if(isset($page)){

			return $page;

		//If there's not a page on the same level with a higher sort order, look at the parent's level (part) and find the next part.
		}else{
			$parent = $this->getParent();
			if(isset($parent)){
				$page = Page::get()->filter( array (
					'ParentID' => $parent->ParentID,
					'Sort:GreaterThanOrEqual' => $parent->Sort,
				) )->exclude(array('ID' => $parent->ID))->First();	
				return $page;			
			}
		}
	}
	
}

