<?php
namespace core\view\compilers;

class BladeCompiler extends Compiler{

    use core\view\compilers\CompileEchos;

    protected $contentTags = ['{{', '}}'];

    /**
     * All of the available compiler functions.
     *
     * @var array
     */
    protected $compilers = [
        'Comments',
        'Extensions',
        'Statements',
        'Echos',
    ];

    //compile view at a given path
    public function compile(){

        $contents = $this->compileString($this->files->get($this->path));
        
        $this->files->put($this->path,$contents);
    }

    //return the contents of a view to be compiled
    public function compileString($value){

        $result = '';

        foreach (token_get_all($value) as $token) {
            $result .= is_array($token) ? $this->parseToken($token) : $token;
        }

        return $result;

    }

    //parse token
    public function parseToken($token){

        [$id, $content] = $token;
        
       
        if ($id == T_INLINE_HTML) { //T_INLINE_HTML - anything outside of php blocks
           
            foreach ($this->compilers as $type) {
                print_r($type);
                $content = $this->{"compile{$type}"}($content);
            }
           
        }

        return $content;
    }

}



