<?php

class IssueBook extends BaseModel
{
	static $table_name = 'issue_books';
	static $primary_key = 'id';

	static $belongs_to = array(
		array(
			'org_book',
            'class_name'=>'OrganizationBook',
            'foreign_key'=>'org_book_id'
		),
		array(
			'member',
			'class_name'=>'Member',
			'foreign_key'=>'member_id'
			)
		);

	public function set_org_book($org_book)
	{
		if($org_book == '')
		{
			throw new BookNotSelectedException("Please Enter Book Name.");
		}
		$org_book->check_is_valid();

		$this->assign_attribute('org_book_id',$org_book->id);
	}

	public function set_member($member)
	{
		$member->check_is_valid();

		$this->assign_attribute('member_id',$member->id);
	}

	public static  function check_issue_count_by_member($member)
	{
		$issues = IssueBook::find_all_by_member_id($member->id);
		$count = count($issues);
		if($count>5)
		{
			throw new LimitedBookIssueException("You cannot issue more than 6 books");
		}
		return;
	}

	public static function check_if_exists($data)
	{
		$issue = IssueBook::find_by_member_id_and_org_book_id_and_is_deleted($data['member']->id,$data['org_book']->id,0);
		if($issue)
		{
			throw new AlreadyIssuedException('You have already issued this book!');
		}

		return;
	}

	public static function create($data)
	{
		$issue_book = new IssueBook();

		self::check_issue_count_by_member($data['member']);
		$issue_book->member = $data['member'];
		
		$issue_book->org_book = $data['org_book'];
		$data['org_book']->issue_book_to_member();
		
		$issue_book->is_active = 1;
		$issue_book->is_deleted = 0;

		self::check_if_exists($data);

		$issue_book->save();
		return $issue_book;
	}


	public function return_book()
	{
        $this->delete();
        $org_book = $this->org_book;       
        $org_book->book_returned_by_member();
	}


}