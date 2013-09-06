<?php 

include_once('Exceptions.php');

class BaseModel extends ActiveRecord\Model
{
	public function check_is_valid()
	{
		if($this->is_deleted==1)
		{
			throw new DeletedException("Already Deleted!");
		}

        if($this->is_active==0)
        {
            throw new InactiveException("It is Inactive!");
        }
	}

    public function set_is_active($is_active)
    {
        $this->assign_attribute('is_active',$is_active);
    }

    public function set_is_deleted($is_deleted)
    {
        $this->assign_attribute('is_deleted',$is_deleted);
    }

	public function delete()
    {
        $this->is_active = 0;
        $this->is_deleted = 1;

        $this->save();
    }

    public function deactivate()
    {
        $this->is_active = 0;
        $this->is_deleted = 0;

        $this->save();
    }

    public function activate()
    {
        $this->is_active = 1;
        $this->is_deleted = 0;

        $this->save();
    }

    public static function __callStatic($method, $args)
    {
        if(substr($method,0,15)=='echo_table_name')
        {
            return static::$table_name;
        }

        if(substr($method,0,15)=='echo_class_name')
        {
            return get_called_class();
        }

        if(substr($method,0,13) == 'find_valid_by')
        {
            $method = 'find_by'.substr($method, 13);
            $model = parent::__callStatic($method, $args);

            self::check_validity($model);

            return $model;           
        }

        $model = parent::__callStatic($method, $args);
        return $model;
    }

    public function check_validity($model) {

        if(!$model) {

            throw new ModelDoesNotExistException('Model does not exist. ');
        }

        $model->check_is_valid();
    }
}