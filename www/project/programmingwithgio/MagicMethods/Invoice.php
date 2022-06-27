<?php


namespace ProgrammingWithGio\MagicMethods;


class Invoice
{
    // Getter & Setter methods
    protected array $data = [];

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    public function __set(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    // Isset & Unset methods

    public function __isset(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    public function __unset(string $name): void
    {
        unset($this->data[$name]);
    }

    // Call method (название метода, аргументы метода)
    // вроде мощные штуки, можно откладывать вызов методов/ зачем?
    // зачем нужны коллбеки в php???
    // todo Гуглить примеры
    private function process(float $amount, $d)
    {
        var_dump($amount, $d);
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            call_user_func_array([$this, $name], $arguments);
        }
    }

    public static function __callStatic(string $name, array $arguments)
    {
        var_dump('static', $name, $arguments);
    }

    // To String / возвращает string при вызове класса

    public function __toString(): string // следить за возвращаемым типом (особенно, если strict_types = 1)
    {
        return 'Init'; // вроде полезно для отладки (например, время инициализации класса)
    } // в php < 8.0 класс должен implements Stringable

    // Invoke прикольно | юзабельно в Singleton??? паттерне при наличии множества классов с единственным методом
    //todo Singleton дальше, попробовать invoke
    public function __invoke()
    {
        var_dump('invoked');
    }

    public function __debugInfo(): ?array // управление дампом
    {
        return [
            'someKey' => 'someArg',
            ...
        ];
    }
}