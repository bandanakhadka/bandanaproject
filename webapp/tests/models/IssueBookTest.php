<?php

class IssueBookTest extends CIUnit_TestCase
{
	protected $tables = array(
							'issue_books'=>'issue_books',
							'books'=>'books',
							'member'=>'member'							
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

	public function test_set_book()
	{
		$issue_book = new IssueBook();
		$book = Book::find_by_id($this->books_fixt['1']['id']);
		$issue_book->book = $book;
		$this->assertEquals($issue_book->book_id,$book->id);
	}

	public function test_set_member()
	{
		$issue_book = new IssueBook();
		$member = Member::find_by_id($this->member_fixt['1']['id']);
		$issue_book->member = $member;
		$this->assertEquals($issue_book->member_id,$member->id);
	}

	public function test_set_issued_quantity()
	{
		$issue_book = new IssueBook();
		$issue_book->issued_quantity = 1;
		$this->assertEquals($issue_book->issued_quantity,1);
	}

	public function test_set_book_exception()
	{
		$issue_book = new IssueBook();
		$this->setExpectedException('BookNotSelectedException');
		$issue_book->book = '';
	}

	public function test_set_inactive_book_exception()
	{
		$issue_book = new IssueBook();
		$book = Book::find_by_id($this->books_fixt['2']['id']);
		$this->setExpectedException('InactiveException');
		$issue_book->book = $book;
	}

	public function test_set_deleted_book_exception()
	{
		$issue_book = new IssueBook();
		$book = Book::find_by_id($this->books_fixt['3']['id']);
		$this->setExpectedException('DeletedException');
		$issue_book->book = $book;
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

	public function test_set_issued_quantity_exception()
	{
		$issue_book = new IssueBook();
		$this->setExpectedException('InvalidIssueException');
		$issue_book->issued_quantity = '';
	}

	public function test_set_invalid_issued_quantity_exception()
	{
		$issue_book = new IssueBook();
		$this->setExpectedException('InvalidIssueException');
		$issue_book->issued_quantity = -1;
	}

	public function test_book_issue()
	{
		$issue_book = IssueBook::find_by_id($this->issue_books_fixt['1']['id']);
		$quantity = $issue_book->issued_quantity;
		$issue_book->issue_book();
		$this->assertEquals($issue_book->issued_quantity,$quantity+1);
	}

	public function test_book_return()
	{
		$issue_book = IssueBook::find_by_id($this->issue_books_fixt['1']['id']);
		$quantity = $issue_book->issued_quantity;
		$issue_book->return_book();
		$this->assertEquals($issue_book->issued_quantity,$quantity-1);
	}

	public function test_book_issue_count_exception()
	{
		$issue_book = IssueBook::find_by_id($this->issue_books_fixt['1']['id']);
		$quantity = $issue_book->issued_quantity;
		$this->setExpectedException('CannotIssueException');
		$issue_book->issue_book();
	}

	public function test_book_return_exception()
	{
		$issue_book = IssueBook::find_by_id($this->issue_books_fixt['2']['id']);
		$this->setExpectedException('InvalidReturnException');
		$issue_book->return_book();
	}

	public function test_create()
	{
		$book = Book::find_by_id($this->books_fixt['1']['id']);
		$member = Member::find_by_id($this->member_fixt['1']['id']);

		$issue_book = IssueBook::create(array(
						'book'=>$book,
						'member'=>$member,
						'issued_quantity'=>1
						)
					);

		$this->assertEquals($issue_book->book_id,$book->id);
		$this->assertEquals($issue_book->member_id,$member->id);
		$this->assertEquals($issue_book->issued_quantity,1);
		$this->assertEquals($issue_book->is_active,1);
		$this->assertEquals($issue_book->is_deleted,0);

	}

	public function test_create_exception()
	{
		$book = Book::find_by_id($this->books_fixt['1']['id']);
		$member = Member::find_by_id($this->member_fixt['4']['id']);

		$this->setExpectedException('LimitedBookIssueException');
		$issue_book = IssueBook::create(array(
						'book'=>$book,
						'member'=>$member,
						'issued_quantity'=>1
						)
					);
	}

}