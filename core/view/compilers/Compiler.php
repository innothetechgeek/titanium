<?php
namespace core\view\compilers;

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
}