<?php

namespace LOG\Factory;

use LOG\LoggerInstances\LoggerDataBase;
use LOG\LoggerInstances\LoggerFile;
use LOG\LoggerInstances\LoggerStdOut;

/*
* Класс, созданный по шаблону Factory
* Позволяет создавать конкретный тип логирования
*/
class LoggerFactory
{
    public static function createFileLogger($name, $fname)
    {
        return LoggerFile::create($name, $fname);
    }

    public static function createDataBaseLogger($localhost, $root, $password, $db)
    {
        return LoggerDataBase::create($localhost, $root, $password, $db);
    }

    public static function createStdOutLogger($name)
    {
        return LoggerStdOut::create($name);
    }
}
