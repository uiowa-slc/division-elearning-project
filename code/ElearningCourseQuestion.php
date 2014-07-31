<?php
class ElearningCourseQuestion extends ElearningCoursePage {

	private static $db = array(
	);
	
	private $has_many = array(
	);

	private static $has_one = array(
	);

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
		$fields = new FieldList();
		$actions = new FieldList(
			FormAction::create("doCheckAnswers")->setTitle("Check Answers")
		);
		$form = new Form($this, 'ChapterQuestionForm', $fields, $actions);
		$form->loadDataFrom($this->request->postVars());
		return $form;
	}
	
	public function doCheckAnswers($data, Form $form) {
		//check answers
		return $this->render();
	}

}

