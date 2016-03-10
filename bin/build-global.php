<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/array_functions.php';
require_once __DIR__ . '/../src/case_functions.php';
require_once __DIR__ . '/../src/class_functions.php';
require_once __DIR__ . '/../src/string_functions.php';
require_once __DIR__ . '/../src/server_functions.php';
require_once __DIR__ . '/../src/file_functions.php';

$userFunctions = get_defined_functions()['user'];
$jasnyFunctions = [];

foreach ($userFunctions as $function) {
    if (strpos($function, 'jasny\\') === 0) {
        $jasnyFunctions[] = $function;
    }
}

$code = [];

foreach ($jasnyFunctions as $function) {
    $refl = new ReflectionFunction($function);
    $doc = $refl->getDocComment();
    
    $globfn = substr($function, strlen('jasny\\'));
    if (strpos($globfn, '\\') !== false) continue;
    
    if (function_exists($globfn)) continue;
    
    $reflParams = $refl->getParameters();
    foreach ($reflParams as $param) {
        $params[] = join(' ', array_filter([
            $param->getClass(),
            $param->isArray() ? 'array' : null,
            '$' . $param->getName(),
            $param->isDefaultValueAvailable() ? '= ' . var_export($param->getDefaultValue(), true) : null
        ]));
        
        $args[] = '$' . $param->getName();
    }
    
    $paramStr = join(', ', $params);
    $argsStr = join(', ', $args);
    
    $code[] = <<<CODE
$doc
function $globfn($paramStr)
{
    return $function($argsStr);
}

CODE;

    unset($params, $args);
}

file_put_contents(dirname(__DIR__) . '/src/global.php', "<?php\n\n" . join("\n", $code));

echo "Created src/global.php\n";

