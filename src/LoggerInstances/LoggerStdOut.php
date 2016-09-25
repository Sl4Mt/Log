<?php

namespace LOG\LoggerInstances;

use Psr\Log\LoggerInterface;
use Psr\Log\InvalidArgumentException;

/*
 * Класс, который описывает запись логов в STDOUT, создан по шаблону Singleton
 */
class LoggerStdOut implements LoggerInterface
{
    // Детальная отладочная информация.
    const DEBUG = 100;
    
    // Информация, полезная для понимания происходящего события.
    const INFO = 200;
    
    // Замечание, важное событие.
    const NOTICE = 300;
    
    // Предупреждение, нештатная ситуация, не являющаяся ошибкой.
    const WARNING = 400;
    
    // Ошибка на стадии выполнения.
    const ERROR = 500;
    
    // Критическая ошибка, критическая ситуация.
    const CRITICAL = 600;
    
    // Тревога, меры должны быть предприняты незамедлительно.
    const ALERT = 700;
    
    // Авария, система неработоспособна.
    const EMERGENCY = 800;
    
    protected static $levels = array(
        self::DEBUG     => 'DEBUG',
        self::INFO      => 'INFO',
        self::NOTICE    => 'NOTICE',
        self::WARNING   => 'WARNING',
        self::ERROR     => 'ERROR',
        self::CRITICAL  => 'CRITICAL',
        self::ALERT     => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    );
    
    // Все созданные объекты логов
    protected static $loggers = array();
    
    // Имя журнала
    protected $name;

    // Создаем закрытый конструктор
    private function __construct($name)
    {
        $this->name = $name;
    }

    // Предотвратить клонирование объекта
    private function __clone()
    {       
    }

    // Предотвратить десериализации экземпляра класса через глобальную функцию \unserialize().
    private function __wakeup()
    {       
    }

    // Открытый метод, предназначенный для создания объектов класса
    public static function create($name)
    {
        // Если логер с таким именем существует, то его и возвращаем
        if (isset(self::$loggers[$fname])) {
            return self::$loggers[$fname];
        }
        // Иначе создаем новый и сохраняем
        return self::$loggers[$name] = new self($name);
    }

    function __destruct()
    {
    }
    
    public static function getLevelName($level)
    {
        if (!isset(static::$levels[$level])) {
            throw new InvalidArgumentException('Level "'.$level.'" is not defined, use one of: '.implode(', ', array_keys(static::$levels)));
        }
        return static::$levels[$level];
    }
    
    public static function toLevel($level)
    {
        if (is_string($level)) {
            if (defined(__CLASS__.'::'.strtoupper($level))) {
                return constant(__CLASS__.'::'.strtoupper($level));
            }
            throw new InvalidArgumentException('Level "'.$level.'" is not defined, use one of: '.implode(', ', array_keys(static::$levels)));
        }
        return $level;
    }
    
    public function addRow($level, $message, array $context = array())
    {        
        if (static::getLevelName($level) === null) {
            throw new InvalidArgumentException('Level "'.$level.'" is not defined, use one of: '.implode(', ', array_keys(static::$levels)));
        }
        $replace = array();
        $line = $message;

        if ($context !== null) {
            foreach ($context as $key => $val) {
                if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                    $replace['{' . $key . '}'] = $val;
                }
            }
            $line = strtr($message, $replace);
        }
        
        date_default_timezone_set('Europe/Moscow');
        
        $str = "[" . date("Y-m-d_H:m:s ") . "{$line}] " . PHP_EOL;
        
        $stdout = fopen('php://stdout', 'w');
        fwrite($stdout, $str);

        return true;
    }

    public function log($level, $message, array $context = array())
    {
        $lev = static::toLevel($level);

        return $this->addRow($lev, $message, $context);
    }

    public function emergency($message, array $context = array())
    {
        return $this->addRow(static::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = array())
    {
        return $this->addRow(static::ALERT, $message, $context);
    }

    public function critical($message, array $context = array())
    {
        return $this->addRow(static::CRITICAL, $message, $context);
    }

    public function error($message, array $context = array())
    {
        return $this->addRow(static::ERROR, $message, $context);
    }

    public function warning($message, array $context = array())
    {
        return $this->addRow(static::WARNING, $message, $context);
    }

    public function notice($message, array $context = array())
    {
        return $this->addRow(static::NOTICE, $message, $context);
    }

    public function info($message, array $context = array())
    {
        return $this->addRow(static::INFO, $message, $context);
    }

    public function debug($message, array $context = array())
    {
        return $this->addRow(static::DEBUG, $message, $context);
    }
}
