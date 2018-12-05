<?php
class ElearningCoursePart extends ElearningCoursePage {

	private static $db = array(
		
	);

	private static $has_one = array(
	);

	private static $allowed_children = array("ElearningCourseChapter", "ElearningCourseQuestion");

	private static $singular_name = 'Part';

	private static $plural_name = 'Parts';

	private static $default_parent = "ElearningCourseHome";
	private static $can_be_root = false;
	
	public function Course(){
		$pageTemp = $this;
		while($pageTemp->ClassName != 'ElearningCourseHome'){
			$pageTemp = $this->getParent();
		}
		return $pageTemp;
	}

	
	public function getNextPage() {
		//If part has children, then the next page is its first child.
		if($this->Children()->First()){
			return $this->Children()->First();
		}else{
			$page = Page::get()->filter( array (
				'ParentID' => $this->ParentID,
				'Sort:GreaterThan' => $this->Sort
			) )->First();
		}
		if(isset($page)){
			return $page;
		}
	}
	
}