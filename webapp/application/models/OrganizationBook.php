<?php

class OrganizationBook extends BaseModel
{
	static $table_name = 'organization_books';
	static $primary_key = 'id';

	static $belongs_to = array(
		array(
			'book',
            'class_name'=>'Book',
            'foreign_key'=>'book_id'
		),
		array(
			'organization',
			'class_name'=>'Organization',
			'foreign_key'=>'org_id'
			)
		);

	public function set_organization($organization)
	{
		if($organization == '')
		{
			throw new NoOrganizationException("Please Enter Organization Name.");
		}
		$organization->check_is_valid();

		$this->assign_attribute('org_id',$organization->id);
	}

	public function set_book($book)
	{
		if($book == '')
		{
			throw new NoBookException("Please Enter Book Name.");
		}
		$book->check_is_valid();

		$this->assign_attribute('book_id',$book->id);
	}

	public function set_total_books($quantity)
	{
		if($quantity == '')
		{
			throw new EmptyQuantityException("Please Enter no. of books.");
		}

		if($quantity<0)
		{
			throw new InvalidQuantityException("Please Enter valid no. of books.");
		}

		if($quantity<$this->issued_books)
		{
			throw new QuantityException('Invalid quantity entered!');
		}

		$this->assign_attribute('total_books',$quantity);
	}

	public function get_total_books()
	{
		return $this->read_attribute('total_books');
	}

	public function get_issued_books()
	{
		return $this->read_attribute('issued_books');
	}

	public function get_available_books()
	{
		return $this->read_attribute('available_books');
	}

	public static function create($data)
	{
		$org_book = new OrganizationBook();

		$org_book->book = $data['book'];
		$org_book->organization = $data['organization'];
		$org_book->total_books = $data['total_books'];
		$org_book->issued_books = 0;
		$org_book->available_books = $data['total_books'];
		$org_book->is_active = 1;
		$org_book->is_deleted = 0;

		$org_book->save();
		return $org_book;
	} 

	public function issue_book_to_member()
	{
		if ($this->available_books == 0)
        {
          throw new InvalidIssueException("Invalid Quantity Given");  
        }

        $this->issued_books += 1;
        $this->available_books -= 1;
        $this->save();
	}

	public function book_returned_by_member()
	{
		if($this->issued_books==0)
        {
           throw new InvalidReturnException("invalid transaction");
        }

        $this->issued_books -=1 ;
        $this->available_books +=1;
        $this->save();
	}



}