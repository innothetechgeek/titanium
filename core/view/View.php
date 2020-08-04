<?php
namespace core\view;

class View{

    protected $data;
    protected $name;
    protected $path;

     /**
     * The view factory instance.
     *
     * @var \Illuminate\View\Factory
     */
    protected $factory;

    public function __construct(Factory $factory,$name,$data,$path){
       
        $this->factory = $factory;
        $this->name = $name;
        $this->data = $data;
        $this->path = $path;        

    }

    public function render(){
        return $this->getContents();
    }

    public function getContents(){
        $data = $this->data;
        
        return file_get_contents($this->path);

    }
}