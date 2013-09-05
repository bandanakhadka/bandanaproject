<?php

class BookTest extends CIUnit_TestCase
{
	protected $tables = array(
							'books'=>'books',
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

	public function test_set_name()
	{
		$book = new Book();
		$book->name = 'Shirish ko Ful';
		$this->assertEquals($book->name,'Shirish ko Ful');
	}

	public function test_set_author()
	{
		$book = new Book();
		$book->author = 'Parijat';
		$this->assertEquals($book->author,'Parijat');
	}

	public function test_set_language()
	{
		$book = new Book();
		$book->language = 'Nepali';
		$this->assertEquals($book->language,'Nepali');
	}

	public function test_set_price()
	{
		$book = new Book();
		$book->price = 200;
		$this->assertEquals($book->price,200);
	}

	public function test_set_name_exception()
	{
		$book = new Book();
		$this->setExpectedException('EmptyNameException');
		$book->name = '';
	}

	public function test_set_author_exception()
	{
		$book = new Book();
		$this->setExpectedException('EmptyAuthorException');
		$book->author = '';
	}

	public function test_set_language_exception()
	{
		$book = new Book();
		$this->setExpectedException('EmptyLanguageException');
		$book->language = '';
	}

	public function test_set_price_exception()
	{
		$book = new Book();
		$this->setExpectedException('EmptyPriceException');
		$book->price = '';
	}

	public function test_set_invalid_price_exception()
	{
		$book = new Book();
		$this->setExpectedException('InvalidPriceException');
		$book->price = -50;
	}

	public function test_create_book()
	{
		$book = Book::create(array(
				'name'=>'Shirish ko Ful',
				'author'=>'Parijat',
				'language'=>'Nepali',
				'price'=>200
				)
			);

		$this->assertEquals($book->name,'Shirish ko Ful');
		$this->assertEquals($book->author,'Parijat');
		$this->assertEquals($book->language,'Nepali');
		$this->assertEquals($book->price,200);
		$this->assertEquals($book->is_active,1);
		$this->assertEquals($book->is_deleted,0);
	}

	public function test_create_book_with_exception()
	{
		$book = Book::find_by_id($this->books_fixt['4']['id']);

		$this->setExpectedException('BookAlreadyExistsException');
		$new_book = Book::create(array(
				'name'=>'Palpasa Cafe',
				'author'=>'Narayan Wagle',
				'language'=>'Nepali',
				'price'=>200
				)
			);
	}

}