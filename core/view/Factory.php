<?php
namespace core\view;
/*
 * @Author: Khusela Mphokeli 
 * @Date: 2020-08-05 01:49:49 
 * @Last Modified by:   Khusela Mphokeli 
 * @Last Modified time: 2020-08-05 01:49:49 
 */



class Factory{

    use compilers\CompileLayouts;
/**
     * Data that should be available to all templates.
     *
     * @var array
     */
    protected $shared = [];

    public function __construct(){
        
        $this->share('__env', $this);
       
    }

    public function make($name,$data,$path){
           
        $view = new View($this,$name,$data,$path);
        return $view->render();

    }

     /**
     * Add a piece of shared data to the environment.
     *
     * @param  array|string  $key
     * @param  mixed|null  $value
     * @return mixed
     */
    public function share($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            $this->shared[$key] = $value;
        }

        return $value;
    }

     /**
     * Get an item from the shared data.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function shared($key, $default = null)
    {
        return $this->shared[$key];
    }

     /**
     * Get all of the shared data for the environment.
     *
     * @return array
     */
    public function getShared()
    {
        return $this->shared;
    }
}