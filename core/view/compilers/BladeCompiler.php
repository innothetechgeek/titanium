<?php
namespace core\view\compilers;
use \core\fileSystem\FileSystem;

class BladeCompiler extends Compiler{

    use CompileEchos;
    use CompileLayouts;

    /**
     * Array of footer lines to be added to template.
     *
     * @var array
     */
    protected $footer = [];

      /**
     * Array of opening and closing tags for raw echos.
     *
     * @var array
     */
    protected $rawTags = ['{!!', '!!}'];

    /**
     * Array of opening and closing tags for regular echos.
     *
     * @var array
     */
    protected $contentTags = ['{{', '}}'];

    /**
     * Array of opening and closing tags for escaped echos.
     *
     * @var array
     */
    protected $escapedTags = ['{{{', '}}}'];
     /**
     * The "regular" / legacy echo string format.
     *
     * @var string
     */
    protected $echoFormat = 'e(%s)';


    /**
     * All of the available compiler functions.
     *
     * @var array
     */
    protected $compilers = [
        'Statements',
        'Echos',
    ];

    protected $rawBlocks = [];

    protected $path;

    //compile view at a given path
    public function compile($path){
        $this->setPath($path);
        
       
        $contents = $this->compileString($this->files->get($this->getPath()));
       
        $this->files->put($this->getCompiledPath($path),$contents);
    }

    //return the contents of a view to be compiled
    public function compileString($value){

           
            $result = '';
            $value = $this->storeUncompiledBlocks($value);
        
            // Here we will loop through all of the tokens returned by the Zend lexer and
            // parse each one into the corresponding valid PHP. We will then have this
            // template as the correctly rendered PHP that can be rendered natively.
            
            foreach (token_get_all($value) as $token) {
                $result .= is_array($token) ? $this->parseToken($token) : $token;
            }
            
          
    
            if (! empty($this->rawBlocks)) {
                $result = $this->restoreRawContent($result);
            }

            
            
            // If there are any footer lines that need to get added to a template we will
            // add them here at the end of the template. This gets used mainly for the
            // template inheritance via the extends keyword that should be appended.
            if (count($this->footer) > 0) {
                $result = $this->addFooters($result);
            }
           
            return $result;

    }

    //parse token
    public function parseToken($token){

       
        [$id, $content] = $token;
        
       
        if ($id == T_INLINE_HTML) { //T_INLINE_HTML - anything outside of php blocks
           
            foreach ($this->compilers as $type) {
                
                $content = $this->{"compile{$type}"}($content);
            }          
           
        }
       
        return $content;
    }
     /**
     * Get the path currently being compiled.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
     /**
     * Set the path currently being compiled.
     *
     * @param  string  $path
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Store a raw block and return a unique raw placeholder.
     *
     * @param  string  $value
     * @return string
     */
    protected function storeRawBlock($value)
    {
        return $this->getRawPlaceholder(
            array_push($this->rawBlocks, $value) - 1
        );
    }

    /**
     * Replace the raw placeholders with the original code stored in the raw blocks.
     *
     * @param  string  $result
     * @return string
     */
    protected function restoreRawContent($result)
    {
        $result = preg_replace_callback('/'.$this->getRawPlaceholder('(\d+)').'/', function ($matches) {
            return $this->rawBlocks[$matches[1]];
        }, $result);

        $this->rawBlocks = [];

        return $result;
    }

    /**
     * Get a placeholder to temporary mark the position of raw blocks.
     *
     * @param  int|string  $replace
     * @return string
     */
    protected function getRawPlaceholder($replace)
    {
        return str_replace('#', $replace, '@__raw_block_#__@');
    }
     /**
     * Store the blocks that do not receive compilation.
     *
     * @param  string  $value
     * @return string
     */
    protected function storeUncompiledBlocks($value)
    {
        if (strpos($value, '@verbatim') !== false) {
            $value = $this->storeVerbatimBlocks($value);
        }

        if (strpos($value, '@php') !== false) {
            $value = $this->storePhpBlocks($value);
        }

        return $value;
    }

    /**
     * Compile Blade statements that start with "@".
     *
     * @param  string  $value
     * @return string
     */
    protected function compileStatements($value)
    {
        return preg_replace_callback(
            '/\B@(@?\w+(?:::\w+)?)([ \t]*)(\( ( (?>[^()]+) | (?3) )* \))?/x', function ($match) {
               
                return $this->compileStatement($match);
            }, $value
        );

    }

    /**
     * Compile a single Blade @ statement.
     *
     * @param  array  $match
     * @return string
     */
    protected function compileStatement($match)
    {
        
        if (strpos($match[1], '@')) {
            $match[0] = isset($match[3]) ? $match[1].$match[3] : $match[1];
        } elseif (isset($this->customDirectives[$match[1]])) {
           
            $match[0] = $this->callCustomDirective($match[1], $match[2]);
        } elseif (method_exists($this, $method = 'compile'.ucfirst($match[1]))) {
          
            $match[0] = $this->$method($match[3]);
        }

        return isset($match[3]) ? $match[0] : $match[0].$match[2];
    }


        /**
     * Add the stored footers onto the given content.
     *
     * @param  string  $result
     * @return string
     */
    protected function addFooters($result)
    {
        return ltrim($result, PHP_EOL)
                .PHP_EOL.implode(PHP_EOL, array_reverse($this->footer));
    }

     /**
     * Strip the parentheses from the given expression.
     *
     * @param  string  $expression
     * @return string
     */
    public function stripParentheses($expression)
    {
       
        if ((strpos($expression, '(') === 0)) {
            $expression = substr($expression, 1, -1);
        }

        return $expression;
    }
   

}



