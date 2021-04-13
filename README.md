# translite-code 
# В самом файле необходмио указать корректный апи-ключ. 
# Пример вызова:


require __DIR__.'/translit.php';

$obj = new Main\Classes\Translation;

$result = $obj->translate_text();

print_r($result);

