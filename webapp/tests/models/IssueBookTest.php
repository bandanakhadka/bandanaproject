<?php

class IssueBookTest extends CIUnit_TestCase
{
	protected $tables = array(
							'issue_books'=>'issue_books',
							'member'=>'member',
							'organizations'=>'organizations',
							'organization_books'=>'organization_books'					
							);

	public function __construct()
	{
		parent::__construct();
	}

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function test_set_org_book()
	{
		$issue_book = new IssueBook();
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['1']['id']);
		$issue_book->org_book = $org_book;
		$this->assertEquals($issue_book->org_book_id,$org_book->id);
	}

	public function test_set_member()
	{
		$issue_book = new IssueBook();
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		$issue_book->member = $member;
		$this->assertEquals($issue_book->member_id,$member->id);
	}

	public function test_set_org_book_exception()
	{
		$issue_book = new IssueBook();
		$this->setExpectedException('BookNotSelectedException');
		$issue_book->org_book = '';
	}

	public function test_set_inactive_org_book_exception()
	{
		$issue_book = new IssueBook();
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['3']['id']);
		$this->setExpectedException('InactiveException');
		$issue_book->org_book = $org_book;
	}

	public function test_set_deleted_org_book_exception()
	{
		$issue_book = new IssueBook();
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['4']['id']);
		$this->setExpectedException('DeletedException');
		$issue_book->org_book = $org_book;
	}

	public function test_set_inactive_member_exception()
	{
		$issue_book = new IssueBook();
		$member = Member::find_by_id($this->member_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$issue_book->member = $member;
	}

	public function test_set_deleted_member_exception()
	{
		$issue_book = new IssueBook();
		$member = Member::find_by_id($this->member_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$issue_book->member = $member;
	}

	public function test_book_return()
	{
		$issue_book = IssueBook::find_by_id($this->issue_books_fixt['1']['id']);
		$org_book = $issue_book->org_book;
		$issued_books_before = $org_book->issued_books;
		$available_books_before = $org_book->available_books;

		$issue_book->return_book();

		$this->assertEquals($issue_book->is_deleted,1);
		$org_book->reload();
		$this->assertEquals($org_book->issued_books,$issued_books_before-1);
		$this->assertEquals($org_book->available_books,$available_books_before+1);
	}

	public function test_create()
	{
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['1']['id']);
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		$issued_books_before = $org_book->issued_books;
		$available_books_before = $org_book->available_books;

		$issue_book = IssueBook::create(array(
						'org_book'=>$org_book,
						'member'=>$member
						)
					);

		$this->assertEquals($issue_book->org_book_id,$org_book->id);
		$this->assertEquals($issue_book->member_id,$member->id);
		$this->assertEquals($issue_book->is_active,1);
		$this->assertEquals($issue_book->is_deleted,0);
		$org_book->reload();
		$this->assertEquals($org_book->issued_books,$issued_books_before+1);
		$this->assertEquals($org_book->available_books,$available_books_before-1);

	}

	public function test_create_unavailable_exception()
	{
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['2']['id']);
		$member = Member::find_by_id($this->member_fixt['1']['id']);

		$this->setExpectedException('InvalidIssueException');
		$issue_book = IssueBook::create(array(
						'org_book'=>$org_book,
						'member'=>$member
						)
					);
	}

	public function test_create_already_exists_exception()
	{
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['6']['id']);
		$member = Member::find_by_id($this->member_fixt['1']['id']);

		$this->setExpectedException('AlreadyIssuedException');
		$issue_book = IssueBook::create(array(
						'org_book'=>$org_book,
						'member'=>$member
						)
					);
	}

	public function test_check_issue_count_by_member()
	{
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['2']['id']);
		$member = Member::find_by_id($this->member_fixt['4']['id']);

		$this->setExpectedException('LimitedBookIssueException');
		$issue_book = IssueBook::create(array(
						'org_book'=>$org_book,
						'member'=>$member
						)
					);
	}

	
}