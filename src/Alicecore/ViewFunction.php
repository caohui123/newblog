<?php
namespace Alicecore;

class ViewFunction
{
	public $app;

	public function __construct(Controller $controller)
	{
		$this->app = $controller;
	}

	private function getStatic($type, $name)
	{
		$file_dir = dirname(dirname(dirname(__FILE__)))."\\web\\".$type;
        $file_name = '/'.$name;

        if (!file_exists($file_dir.$file_name)) {
            throw new \InvalidArgumentException("Static file '$file_name' not Exists!");
        }
//var_dump($this->app->getRequest()->server);die();
		$website = '/newblog/web/';
        return $website.$type.$file_name;
	}

	public function Route($route)
	{
		return $route;
	}

	public function getCss($name)
	{
		return $this->getStatic('css', $name);
	}

	public function getJs($name)
	{
		return $this->getStatic('js', $name);
	}

	public function getImage($name)
	{
		return $this->getStatic('image', $name);
	}

	public function __call($method, $arguments)
    {
        return $this->app->$method($arguments);
    }
}