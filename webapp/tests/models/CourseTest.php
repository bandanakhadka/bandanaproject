<?php

class CourseTest extends CIUnit_TestCase
{
	protected $tables = array(
		'courses'=>'courses',
		'enrollment'=>'enrollment',
		'organization_enrollment'=>'organization_enrollment'
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

	public function test_set_course_code()
	{
		$course = new Course();
		$course->course_code = "00S";
		$this->assertEquals($course->course_code,"00S");
	}

	public function test_set_course_name()
	{
		$course = new Course();
		$course->course_name = "maths";
		$this->assertEquals($course->course_name,"maths");
	}

	public function test_set_duration_in_hrs()
	{
		$course = new Course();
		$course->duration_in_hrs = 1;
		$this->assertEquals($course->duration_in_hrs,1);
	}

	public function test_set_category()
	{
		$course = new Course();
		$course->category = "maths";
		$this->assertEquals($course->category,"maths");
	}

	public function test_course_code_exception()
	{
		$course = new Course();
		$this->setExpectedException('BlankCourseCodeException');
		$course->course_code = "";
	}

	public function test_course_name_exception()
	{
		$course = new Course();
		$this->setExpectedException('BlankCourseNameException');
		$course->course_name = "";
	}

	public function test_duration_in_hrs_exception()
	{
		$course = new Course();
		$this->setExpectedException('BlankDurationException');
		$course->duration_in_hrs = "";
	}

	public function test_category_exception()
	{
		$course = new Course();
		$this->setExpectedException('BlankCategoryException');
		$course->category = "";
	}
	
	public function test_create()
	{
		$course = Course::create(array(
		 			'course_code'=> '00S',
		 			'course_name'=>'maths',
		 			'duration_in_hrs'=>1,
		 			'category'=>'maths',		 		
		 			)
				);

		$this->assertEquals($course->course_code,'00S');
		$this->assertEquals($course->course_name,'maths');
		$this->assertEquals($course->duration_in_hrs,1);
		$this->assertEquals($course->category,'maths');
		$this->assertEquals($course->is_active,1);
		$this->assertEquals($course->is_deleted,0);
	}

	public function create_mock()
	{
		$mock = $this->getMockBuilder('CI_FTP')
        			 ->disableOriginalConstructor()
        			 ->getMock();
        return $mock;
	}

	public function test_upload_course()
	{
		$config['hostname'] = 'bandana.com';
        $config['username'] = 'bandana';
        $config['password'] = 'bandana';
        $config['port']     = 21;
        $config['passive']  = FALSE;
        $config['debug']    = TRUE;

		$course = Course::find_by_id(1); 

		$mock = $this->create_mock(); 
		$mock->expects($this->any()) 
			 ->method('connect') 
			 ->with($this->equalTo($config)) 
			 ->will($this->returnValue(true)); 
		$result = $course->upload_course($mock,$config);
		$this->assertNull($result);

		$mock1 = $this->create_mock();
		$mock1->expects($this->any()) 
			  ->method('connect') 
			  ->with($this->equalTo($config)) 
			  ->will($this->returnValue(true));

		$mock1->expects($this->any()) 
			  ->method('upload') 
			  ->with('C:\Users\Mingma Sherpa\Documents\GitHub\bandanaproject\webapp\system\upload','/courses/upload') 
			  ->will($this->returnValue(true)); 
		$result1 = $course->upload_course($mock1,$config);
		$this->assertTrue($result1);

	}

	public function test_upload_course_false()
	{
		$config['hostname'] = 'bandana.com';
        $config['username'] = 'bandana';
        $config['password'] = 'bandana';
        $config['port']     = 21;
        $config['passive']  = FALSE;
        $config['debug']    = TRUE;

		$course = Course::find_by_id(1); 

		$new_mock = $this->create_mock();
		$new_mock->expects($this->any()) 
			 	 ->method('connect') 
				 ->with($this->equalTo($config)) 
			 	 ->will($this->returnValue(false)); 
		$new_result = $course->upload_course($new_mock,$config);
		$this->assertFalse($new_result);

		$new_mock1 = $this->create_mock();
		$new_mock1->expects($this->any()) 
			 	  ->method('connect') 
				  ->with($this->equalTo($config)) 
			 	  ->will($this->returnValue(true));

		$new_mock1->expects($this->once()) 
			 	  ->method('upload') 
			 	  ->with('C:\Users\Mingma Sherpa\Documents\GitHub\bandanaproject\webapp\system\upload','/courses/upload') 
			 	  ->will($this->returnValue(false)); 
		$new_result1 = $course->upload_course($new_mock1,$config);
		$this->assertFalse($new_result1);
	}
}