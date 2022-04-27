<?php
    $link = $_POST['url'];

    if(!filter_var($link, FILTER_VALIDATE_URL)){
        return false;
        die();
    }

    if(get_data($link, $html)){
        $data_film = array();
        preg_match("#&url=(.+?)&type=2#", $html, $matches);
        $url_film = base64_decode($matches[1]);
        
        if(get_data($url_film, $html_film)){
            preg_match_all('#iframe src="(.+?)" frameborder=#', $html_film, $matches_film);
            array_push($data_film, $matches_film[1][0]);
            array_push($data_film, $matches_film[1][1]);
        }
        
        if(get_data($url_film, $html_film2)){
            preg_match_all('#scrolling="no" src="(.+?)" width="100%"#', $html_film2, $matches_film2);
            array_push($data_film, $matches_film2[1][0]);
            array_push($data_film, $matches_film2[1][1]);
        }
        echo json_encode($data_film);
    }

    function get_data($link, &$data = ''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36');
    
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if($error){
            return false;
        }
        return true;
    }