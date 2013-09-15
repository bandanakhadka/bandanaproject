<?php

class IndexPage extends NonSessionController
{
	public function index()
	{
		$this->load->view('indexpage');
	}
}