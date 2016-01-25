<?php


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