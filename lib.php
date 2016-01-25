<?php
    require('wordnik/Swagger.php');
    const WORDNIK_API_KEY = 'f0a2ef63198e524dac0080a2bf106182fb048283b81da8dc6';

    function wordnik_request($part_of_speech)
    {
        $wordnik = new APIClient(WORDNIK_API_KEY, 'http://api.wordnik.com/v4');
        $response = $wordnik->getRandomWord($part_of_speech);

        return $response->text;
    }

    function extract_phrases($data)
    {
        $rtn = array();
        $phrases = explode(',', $data['text']);
        foreach ($phrases as $phrase)
        {
            $rtn[] = trim($phrase);
        }

        return $rtn;
    }
?>