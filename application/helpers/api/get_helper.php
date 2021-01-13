<?php
function get($survey, $variables = null, $sample = null){
  require 'config.php';
  require 'auth_helper.php';

  $bearerToken = authenticate();
  
  $url = $dataURL.$survey."/data";

  $headers = array(
    'Accept: text/csv',
    'Authorization: '.$bearerToken['Authorization'].'',
  );

  $sample = urlencode($sample);
  
  $data = "variables={$variables}&sample={$sample}";
  
  $getUrl = $url."?".$data;

  $ch = curl_init($getUrl);

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPGET, true);

  try {
    $response = curl_exec($ch);

    curl_close($ch);
    return retornoApiCSV($response);
  } catch (Exception $e) {
    log_message('app', 'Problemas na API Sphinx: '.$e->getMessage());
  }
}

function retornoApiCSV($stringApi){
  $targetFile = tempnam('temp/',date('dmYHis', time()));
  setupFile($targetFile,$stringApi);

  $data = array();

  try {
    $fp = fopen($targetFile, 'rb');
    while(!feof($fp)) {
      $data[] = fgetcsv($fp,0,';');
    }

    // close and delete temp file
    fclose($fp);
    unlink($targetFile);

    return $data;
  } catch (Exception $e) {
    log_message('app', 'Problemas na API Sphinx: '.$e->getMessage());
  }
}
  
function setupFile($targetFile, $data) {
  file_put_contents($targetFile, $data);
}
