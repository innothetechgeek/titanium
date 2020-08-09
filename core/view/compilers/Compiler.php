<?php
namespace core\view\compilers;
use \core\fileSystem\FileSystem;

class Compiler{

    protected $files;
    protected $cachePath;

    public function __construct(Filesystem $files, $cachePath)
    {
        if (! $cachePath) {
            throw new InvalidArgumentException('Please provide a valid cache path.');
        }

        $this->files = $files;
        $this->cachePath = $cachePath;
    }
     /**
     * Get the path to the compiled version of a view.
     *
     * @param  string  $path
     * @return string
     */
    public function getCompiledPath($path)
    {
        return $this->cachePath.'/'.sha1($path).'.php';
    }
}