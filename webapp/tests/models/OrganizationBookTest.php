<?php

class OrganizationBookTest extends CIUnit_TestCase
{
	protected $tables = array(
							'organization_books'=>'organization_books',
							'books'=>'books',
							'organizations'=>'organizations'							
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

	public function test_set_organization()
	{
		$org_book = new OrganizationBook();
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);
		$org_book->organization = $organization;
		$this->assertEquals($org_book->org_id,$organization->id);
	}

	public function test_set_book()
	{
		$org_book = new OrganizationBook();
		$book = Book::find_by_id($this->books_fixt['1']['id']);
		$org_book->book = $book;
		$this->assertEquals($org_book->book_id,$book->id);
	}

	public function test_set_total_books()
	{
		$org_book = new OrganizationBook();
		$org_book->total_books = 5;
		$this->assertEquals($org_book->total_books,5);
	}

	public function test_set_organization_exception()
	{
		$org_book = new OrganizationBook();
		$this->setExpectedException('NoOrganizationException');
		$org_book->organization = '';
	}

	public function test_set_book_exception()
	{
		$org_book = new OrganizationBook();
		$this->setExpectedException('NoBookException');
		$org_book->book = '';
	}

	public function test_set_total_books_exception()
	{
		$org_book = new OrganizationBook();
		$this->setExpectedException('EmptyQuantityException');
		$org_book->total_books = '';
	}

	public function test_set_invalid_total_books_exception()
	{
		$org_book = new OrganizationBook();
		$this->setExpectedException('InvalidQuantityException');
		$org_book->total_books = -3;
	}

	public function test_create()
	{
		$organization = Organization::find_by_id($this->organizations_fixt['1']['id']);
		$book = Book::find_by_id($this->books_fixt['1']['id']);

		$org_book = OrganizationBook::create(array(
						'organization'=>$organization,
						'book'=>$book,
						'total_books'=>5
						)
					);

		$this->assertEquals($org_book->org_id,$organization->id);
		$this->assertEquals($org_book->book_id,$book->id);
		$this->assertEquals($org_book->total_books,5);
		$this->assertEquals($org_book->available_books,5);
		$this->assertEquals($org_book->issued_books,0);
		$this->assertEquals($org_book->is_active,1);
		$this->assertEquals($org_book->is_deleted,0);
	}

	public function test_set_total_books_edit_exception()
	{
		$org_book = OrganizationBook::find_by_org_id_and_book_id($organization->id,$book->id);
		$org_book->issued_books = 10;
		$this->setExpectedException('InvalidQuantityException');
		$org_book->total_books = 8;
	}

	public function test_book_issued_to_member()
	{
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['1']['id']);

		$existing_quantity = $org_book->available_books;
		$existing_quantity1 = $org_book->issued_books;
		$org_book->available_books -= 1; 
		$org_book->issued_books +=1;

		$this->assertEquals($org_book->available_books,$existing_quantity-1);
		$this->assertEquals($org_book->issued_books,$existing_quantity1+1);
	}

	public function test_book_returned_by_member()
	{
		$org_book = OrganizationBook::find_by_id($this->organization_books_fixt['1']['id']);

		$existing_quantity = $org_book->available_books;
		$existing_quantity1 = $org_book->issued_books;
		$org_book->available_books += 1; 
		$org_book->issued_books -=1;

		$this->assertEquals($org_book->available_books,$existing_quantity+1);
		$this->assertEquals($org_book->issued_books,$existing_quantity-1);

	}

}
