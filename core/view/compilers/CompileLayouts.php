<?php
/**
 * @author Khusela Mphokeli
 * @email innothetechgeek@gmail.com
 * @create date 2020-08-11 01:13
 * @modify date 2020-08-11 01:13
 * @desc [description]
 */

namespace core\view\compilers;
use core\view\Factory;


 
    

/**
     * Append content to a given section.
     *
     * @param  string  $section
     * @param  string  $content
     * @return void
     */
trait CompileLayouts{

    /**
     * The parent placeholder for the request.
     *
     * @var mixed
     */
    protected static $parentPlaceholder = [];

     /**
     * The stack of in-progress sections.
     *
     * @var array
     */
    protected $sectionStack = [];

    /**
     * Start injecting content into a section.
     *
     * @param  string  $section
     * @param  string|null  $content
     * @return void
     */
    public function startSection($section, $content = null){
        $this->extendSection($section, $content);
    }

    protected function extendSection($section, $content)
    {
        if (isset($this->sections[$section])) {
            print_r('seccions is set');
            $content = str_replace(static::parentPlaceholder($section), $content, $this->sections[$section]);
        }

        $this->sections[$section] = $content;
    }


     /**
     * Compile the yield statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileYield($expression)
    {
        $method = $this->yieldContent($expression);
        return "<?php echo '$method'; ?>";
    }

     /**
     * Stop injecting content into a section and return its contents.
     *
     * @return string
     */
    public function yieldSection()
    {
        if (empty($this->sectionStack)) {
            return '';
        }

        return $this->yieldContent($this->stopSection());
    }

    /**
     * Compile the show statements into valid PHP.
     *
     * @return string
     */
    protected function compileShow()
    {   
        $method = $this->yieldSection();
        return "<?php echo '$method'; ?>";
    }

    /**
     * Stop injecting content into a section.
     *
     * @param  bool  $overwrite
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function stopSection($overwrite = false)
    {
        if (empty($this->sectionStack)) {
            throw new InvalidArgumentException('Cannot end a section without first starting one.');
        }

        $last = array_pop($this->sectionStack);

        if ($overwrite) {
            $this->sections[$last] = ob_get_clean();
        } else {
            $this->extendSection($last, ob_get_clean());
        }

        return $last;
    }

     /**
     * Compile the section statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileSection($expression)
    {

     
        
        $this->lastSection = trim($expression, "()'\" ");

         
        $res  = $this->startSection($expression);

        return "<?php $res ?>";
    }

   /**
     * Compile the extends statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileExtends($expression)
    {
        
       $expression = $this->stripParentheses($expression);

      
       $path = ROOT . DS . 'app' . DS . 'views' . DS . $expression .'.php';
   
        $viewFactory = new Factory();
        $instance = $viewFactory->make($expression,[],$path);
        
        $echo = "<?php echo '$instance' ?>";
        
        $this->footer[] = $echo;

        return '';
    }

     /**
     * Replace the @parent directive to a placeholder.
     *
     * @return string
     */
    protected function compileParent()
    {

        dd('compiling parent');
        return ViewFactory::parentPlaceholder($this->lastSection ?: '');
    }

    /**
     * Get the parent placeholder for the current request.
     *
     * @param  string  $section
     * @return string
     */
    public static function parentPlaceholder($section = '')
    {
        if (! isset(static::$parentPlaceholder[$section])) {
            static::$parentPlaceholder[$section] = '##parent-placeholder-'.sha1($section).'##';
        }

        return static::$parentPlaceholder[$section];
    }

     /**
     * Get the string contents of a section.
     *
     * @param  string  $section
     * @param  string  $default
     * @return string
     */
    public function yieldContent($section, $default = '')
    {
        $sectionContent = $default instanceof View ? $default : e($default);

        if (isset($this->sections[$section])) {
            $sectionContent = $this->sections[$section];
        }

        $sectionContent = str_replace('@@parent', '--parent--holder--', $sectionContent);

        return str_replace(
            '--parent--holder--', '@parent', str_replace(static::parentPlaceholder($section), '', $sectionContent)
        );
    }

}