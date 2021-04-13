<?php

namespace Main\Classes;

class Translation
{

    const DETECT_YA_URL = 'https://translate.yandex.net/api/v1.5/tr.json/detect';
    const TRANSLATE_YA_URL = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

    private $key = "KEY";
    public $request;
    public $errors;


    function __construct()
    {
        $requiredFields = [
            'text',
            'lang'
        ];

        $errors = [];
        $this->request = $_REQUEST;

        foreach ($requiredFields as $field){
            if(!array_key_exists($field, $this->request)){
                $errors[] = "Field <b>$field</b> is required";
                //throw new InvalidConfigException("Field <b>$field</b> is required");
            }
        }

        if(!empty($errors)) $this->errors = $errors;

    }

    /**
     * @param $format string format need to translate
     * @return string
     */
    public function translateText( $format = "text")
    {

        $errors = $this->errors;
        if($format != 'plain' && $format != 'text' || empty($format)){
            $errors[] = 'Failed format';
        }

        $values = array(
            'key' => $this->key,
            'text' => $this->request['text'],
            'lang' => $this->request['lang'],
            'format' => $format,
        );

        $data = $this->postData($values);

        if ($data['code'] == 200) {
            return $data['text'];
        }
        $data['errors'] = $errors;
        return $data;
    }

    private function postData($values){
        $formData = http_build_query($values);

        $ch = curl_init(self::TRANSLATE_YA_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);

        $json = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($json, true);

        return $data;
    }

    //......
}
