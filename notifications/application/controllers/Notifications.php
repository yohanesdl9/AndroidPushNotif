<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('notification');
	}
	function index(){
		$this->load->view('notification');
	}
	function send(){
		$title = $this->input->post('title');
		$message = $this->input->post('message') ? $this->input->post('message') : '';
		$imageUrl = $this->input->post('image_url') ? $this->input->post('image_url') : '';
		$action = $this->input->post('action') ? $this->input->post('action') : '';
		$actionDestination = $this->input->post('action_destination') ? $this->input->post('action_destination') : '';;
		if($actionDestination ==''){
			$action = '';
		}
		$this->notification->setTitle($title);
		$this->notification->setMessage($message);
		$this->notification->setImage($imageUrl);
		$this->notification->setAction($action);
		$this->notification->setActionDestination($actionDestination);
		$firebase_token = $this->input->post('firebase_token');
		$firebase_api = $this->input->post('firebase_api');
		$topic = $this->input->post('topic');
		$requestData = $this->notification->getNotificatin();
		if($this->input->post('send_to') == 'topic'){
			$fields = array(
				'to' => '/topics/' . $topic,
				'data' => $requestData,
			);
		} else {
			$fields = array(
				'to' => $firebase_token,
				'data' => $requestData,
			);
		}
		// Set POST variables
		$url = 'https://fcm.googleapis.com/fcm/send';
		$headers = array(
			'Authorization: key=' . $firebase_api,
			'Content-Type: application/json'
		);
		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Disabling SSL Certificate support temporarily
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		// Execute post
		$result = curl_exec($ch);
		if($result === FALSE){
			die('Curl failed: ' . curl_error($ch));
		}
		// Close connection
		curl_close($ch);
		
		echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
		echo json_encode($fields,JSON_PRETTY_PRINT);
		echo '</pre></p><h3>Response </h3><p><pre>';
		echo $result;
		echo '</pre></p>';
	}
}
?>