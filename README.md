# translite-code 
# В самом файле необходмио указать корректный апи-ключ. 
# Пример вызова:


require __DIR__.'/Translation.class.php';

$obj = new Main\Classes\Translation;

$result = $obj->translateText();

print_r($result);

