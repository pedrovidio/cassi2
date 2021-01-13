<?php
  function authenticate()
  {
    require 'config.php';

    $ch = curl_init($authURL);

    $data = array(
      'username' => $username,
      'token' => $secretToken,
      'grant_type' => 'personal_token',
      'client_id'=> 'sphinxapiclient'
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $authHeaders);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    try {
      $response = curl_exec($ch);
      curl_close($ch);
      $arrayResponse = json_decode($response);

      $bearerToken = array('Authorization' => 'Bearer ' . $arrayResponse->access_token );

      return $bearerToken;
    } catch (Exception $e) {
      log_message('app', 'Problemas na API Sphinx: '.$e->getMessage());
    }
  }
