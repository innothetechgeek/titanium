<?php
/*
 * @Author: Khusela Mphokeli 
 * @Date: 2020-08-05 01:48:31 
 * @Last Modified by: Khusela Mphokeli
 * @Last Modified time: 2020-08-05 01:51:36
 */
namespace core\view;
use \core\fileSystem\FileSystem;


class View{

    protected $data;
    protected $name;
    protected $path;
    protected $compiler;

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

        $this->cachePath =  ROOT . DS . 'storage' . DS . 'views';
        $this->compiler = new compilers\BladeCompiler(new FileSystem,$this->cachePath);     

    }
    /**
     * 
     */
    public function render(){
       
        return $this->getContents();
    }

    public function getContents(){

        $data = array_merge($this->factory->getShared(),$this->data);
        extract($data);
        
        $viewPath = $this->path;
        $this->compiler->compile($viewPath);        

        include $this->compiler->getCompiledPath( $this->path);

    }
}