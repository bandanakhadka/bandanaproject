<?php

class Book extends BaseModel
{
	static $table_name = 'books';
	static $primary_key = 'id';

	static $has_many = array(
		array(
			'organization_books',
			'class_name'=>'OrganizationBook',
			'foreign_key'=>'book_id'
			)
		);

	public function set_name($name)
	{
		if($name == '')
		{
			throw new EmptyNameException("Please Enter Book Name.");
		}
		$this->assign_attribute('name',$name);
	}

	public function set_author($author)
	{
		if($author == '')
		{
			throw new EmptyAuthorException("Please Enter name of the Author.");
		}
		$this->assign_attribute('author',$author);
	}

	public function set_price($price)
	{
		if($price == '')
		{
			throw new EmptyPriceException("Please Enter price for the book.");
		}
		if($price<0)
		{
			throw new InvalidPriceException('Invalid price amount entered!!');
		}
		$this->assign_attribute('price',$price);
	}

	public function set_language($language)
	{
		if($language == '')
		{
			throw new EmptyLanguageException('Please Enter language of the book.');
		}
		$this->assign_attribute('language',$language);
	}

	public function get_name()
	{
		return $this->read_attribute('name');
	}

	public function get_author()
	{
		return $this->read_attribute('author');
	}

	public function get_price()
	{
		return $this->read_attribute('price');
	}

	public function get_language()
	{
		return $this->read_attribute('language');
	}

	public function check_if_exists($name,$author)
	{
		$book = Book::find_by_name_and_author($name,$author);
		if($book)
		{
			throw new BookAlreadyExistsException("This book is already in database.");
		}
	}

	public static function create($data)
	{
		$book = new Book();
		$book->name = $data['name'];
		$book->author = $data['author'];
		$book->price = $data['price'];
		$book->language = $data['language'];
		$book->is_active = 1;
		$book->is_deleted = 0;

		self::check_if_exists($data['name'],$data['author']);

		$book->save();
		return $book;
	} 

}