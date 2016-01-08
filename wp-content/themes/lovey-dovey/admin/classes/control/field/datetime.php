<?php

class VP_Control_Field_DateTime extends VP_Control_Field
{

	private $_attributes = array();

	private $_defaults;

	public function __construct()
	{
		parent::__construct();

		$this->_defaults = array(
			'time_only'    => false,
			'is_rtl'       => false,
			'control_type' => 'slider',
			'date_format'  => 'm/d/yy',
			'time_format'  => 'HH:mm',
			'min_date'     => '',
			'max_date'     => '',
		);
	}

	public static function withArray($arr = array(), $class_name = null)
	{
		if(is_null($class_name))
			$instance = new self();
		else
			$instance = new $class_name;

		$instance->_basic_make($arr);

		foreach ($instance->_defaults as $name => $default)
		{
			$instance->{$name} = isset($arr[$name]) ? $arr[$name] : $default;
		}

		return $instance;
	}

	protected function _setup_data()
	{
		$opt = array();

		foreach (array_keys($this->_defaults) as $name)
		{
			if($name === 'is_rtl')
				$new_name = 'isRTL';
			else
				$new_name = $this->camelize($name);

			$opt[$new_name] = $this->{$name};
		}

		$this->add_data('opt', $this->make_opt($opt));
		parent::_setup_data();
	}

	public function render($is_compact = false)
	{
		// Setup Data
		$this->_setup_data();
		$this->add_data('is_compact', $is_compact);
		return VP_View::instance()->load('datetime', $this->get_data());
	}

	public function __set($name, $value)
	{
		$this->_attributes[$name] = $value;
	}

	public function __get($name)
	{
		if(array_key_exists($name, $this->_attributes))
		{
			return $this->_attributes[$name];
		}
		return null;
	}

	public function __isset($name)
	{
		return isset($this->_attributes[$name]);
	}

	public function __unset($name)
	{
		unset($this->_attributes[$name]);
	}

	private function camelize($str) {
		$func = create_function('$c', 'return strtoupper($c[1]);');
		return preg_replace_callback('/_([a-z])/', $func, $str);
	}

	private function make_opt($optArray)
	{
		$optString = "";
		foreach ($optArray as $key => $value)
		{
			if( $value !== false and $value !== true ) {
				$val = "'" . $value . "'";
			} else {
				if( $value === true )  $val = 'true';
				if( $value === false ) $val = 'false';
			}
			$optString .= "(" . $key . ":" . $val . ")";
		}
		return $optString;
	}

}

/**
 * EOF
 */