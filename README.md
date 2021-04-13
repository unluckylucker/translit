# translite

echo "<pre>";
require __DIR__.'/translit.php';

$obj = new Main\Classes\Translation;

$result = $obj->translate_text();

print_r($result);
echo "</pre>";
