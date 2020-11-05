<?php

/**
 * @param $url string URL of the specific endpoint of the Spoonacular API
 * @param $parameters array Set of parameters used by the request
 * @return Return response of the curl request as a JSON
 */

function curlRequestSpoonacular(string $url,array $parameters)
{
    // Get cURL resource
    $curl = curl_init();

    // Create query from parameters passed when calling the function
    $parameters_string = http_build_query($parameters);

    // Set curl options with specific URL and parameters
    $options = [
        CURLOPT_URL => $url.'?'.$parameters_string, // Set the request URL
        CURLOPT_RETURNTRANSFER => true, // Return data in case of curl request success
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'), // Response header of Spoonacular are JSON
        CURLOPT_SSL_VERIFYHOST => false, // Enable request without needed a certificate for https URL
        CURLOPT_SSL_VERIFYPEER => false, // Enable request without needed a certificate for https URL
    ];

    // Add options and parameters to the curl session
    curl_setopt_array($curl, $options);

    // Execute the request & save data in $response
    if (!$response = curl_exec($curl)) {
        trigger_error(curl_error($curl));
    }
    // Close the request to clear up some resources
    curl_close($curl);

    //Decode JSON into associative array
    $response = json_decode($response, true);

    return $response;
}

// Set the apiKey to be used for the request
$apiKey = '7dbf6a69290c4971a9ea8e019bfb3867';

// Set parameters
$parameters = [
    'apiKey' => $apiKey,
    'number' => '50', //parameter 1
    //parameter 2
    //parameter 3
];

// Set URL with correct endpoint, see Spoonacular doc
$url='https://api.spoonacular.com/recipes/random';

$response = curlRequestSpoonacular($url,$parameters);

$data = []; //Initialize array of results

foreach($response['recipes'] as $index => $element){

    $data[$index] =[
        'name'=>$element['title'],
        'picture'=>$element['image'],
        'id'=>$element['id'],
        'category'=>$element['dishTypes'],
//        'instruction'=>$element['analyzedInstructions'][0]['steps'],
    ];
    foreach($element['analyzedInstructions'][0]['steps'] as $number=>$instruction){
        $data[$index]['instruction'.$number]=$instruction['step'];
    }
}
var_dump($data);

//JUste une idée
/*foreach($data as $i=>$recipe){
    $i = new \Symfony\Flex\Recipe();
    $i = $this->setID($recipe['id']);
    $i = $this->setName($recipe['name']);
    $i = $this->setPicture($recipe['picture']);
}*/