<?php

class IssueBook extends BaseModel
{
	static $table_name = 'issue_books';
	static $primary_key = 'id';

	static $belongs_to = array(
		array(
			'book',
            'class_name'=>'Book',
            'foreign_key'=>'book_id'
		),
		array(
			'member',
			'class_name'=>'Member',
			'foreign_key'=>'member_id'
			)
		);

	public function set_book($book)
	{
		if($book == '')
		{
			throw new BookNotSelectedException("Please Enter Book Name.");
		}
		$book->check_is_valid();

		$this->assign_attribute('book_id',$book->id);
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
		if($count == 6)
		{
			throw new LimitedBookIssueException("You cannot issue more than 6 books");
		}
		return;
	}

	public static function check_if_book_available($data)
	{
		$org_book = OrganizationBook::find_by_org_id_and_book_id($data['member']->organization_id,$data['book']->id);

		if(!$org_book)
		{
			throw new CannotIssueException("This book is not available in the organization.");
		}

		$org_book->check_is_valid();
		
		if($org_book->available_books == 0)
		{
			throw new UnavailableBookException("This book cannot be issued right now!");
		}

		$org_book->issued_books += 1;
		$org_book->available_books -=1;
		$org_book->save();
		return;

	}

	public static function check_if_exists($member,$book)
	{
		$issue = IssueBook::find_by_member_id_and_book_id_and_is_deleted($member->id,$book->id,0);
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

		self::check_if_book_available($data);		
		$issue_book->book = $data['book'];
		
		$issue_book->is_active = 1;
		$issue_book->is_deleted = 0;

		self::check_if_exists($data['member'],$data['book']);

		$issue_book->save();
		return $issue_book;
	}


	public function return_book()
	{
        $this->delete();
        
        $org_book = OrganizationBook::find_by_org_id_and_book_id($this->member->organization_id,$this->book->id);
        $org_book->issued_books -= 1;
        $org_book->available_books += 1;
        $org_book->save();
	}


}