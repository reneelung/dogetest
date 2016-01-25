<?php
    require('lib.php');

    const USERNAME = 'ReneeLung';
    const PASSWORD = 'pagerdutydoge';
    const URL = 'https://api.imgflip.com/caption_image';
    const TEMPLATE = 8072285;

    $payload = $_POST['text'];
    $respond_to = $_POST['response_url'];
    $phrases = extract_phrases($_POST);

require('wordnik/Swagger.php');
const WORDNIK_API_KEY = 'f0a2ef63198e524dac0080a2bf106182fb048283b81da8dc6';

function wordnik_request($part_of_speech)
{
    $wordnik = new APIClient(WORDNIK_API_KEY, 'http://api.wordnik.com/v4');
    $response = $wordnik->getRandomWord($part_of_speech);

    return $response->text;
}

$wapi = new APIClient(WORDNIK_API_KEY, 'http://api.wordnik.com/v4');
var_dump($wapi->getRandomWord('noun'));

    if (!$phrases)
    {
        $phrases[] = "so ".wordnik_request('noun');
        $phrases[] = "very ".wordnik_request('verb');
        $phrases[] = "much ".wordnik_request('adjective');
        $phrases[] = "WOW";
        $phrases[] = "AMAZE";
    }

    $data = array(
        'username' => USERNAME,
        'password' => PASSWORD,
        'template_id' => TEMPLATE,
        'font' => 'arial',
        'text0' => 'foo',
        'text1' => 'bar',
        'boxes' => array(
            array(
                "text" => $phrases[0],
                "x" => 260,
                "y" => 50,
                "width" => 274,
                "height" => 50,
                "color" => "#FF0000",
                "outline_color" => "#000000"
            ),
            array(
                "text" => $phrases[1],
                "x" => 30,
                "y" => 475,
                "width" => 274,
                "height" => 50,
                "color" => "#ff00ff",
                "outline_color" => "#000000"
            ),
            array(
                "text" => $phrases[2],
                "x" => 400,
                "y" => 525,
                "width" => 137,
                "height" => 25,
                "color" => "#00ffff",
                "outline_color" => "#000000"
            ),
            array(
                "text" => $phrases[3],
                "x" => 400,
                "y" => 360,
                "width" => 225,
                "height" => 40,
                "color" => "#FFFF00",
                "outline_color" => "#000000"
            ),
            array(
                "text" => $phrases[4],
                "x" => 55,
                "y" => 120,
                "width" => 170,
                "height" => 35,
                "color" => "#FFAE00",
                "outline_color" => "#000000"
            ),
        )
    );
print_r($phrases);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = json_decode(file_get_contents(URL, false, $context), true);

    if (!$result['success'] && (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        echo "very sadness, so cry";
        exit;
    } else if (!$result['success']) {
        echo "<html><body><img src='https://media.giphy.com/media/JEVqknUonZJWU/giphy.gif'></body></html>";
        exit;
    }

    $doge_says = array(
        'response_type' => 'in_channel',
        'text' => 'So Doge, Very Slack!',
        'attachments' => array(
            array (
                'fallback' => 'Very Doge!',
                'title' => preg_replace('/,/g', ', ', $payload),
                'title_link' => $result['data']['page_url'],
                'image_url' => $result['data']['url']
            )
        )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $respond_to);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($doge_says));

    $response = curl_exec($ch);

    if (!$response)
    {
        echo "very sadness, so cry";
        exit;
    }
?>

hello hello hello
