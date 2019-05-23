<?php
//Upload file using Upload library

$this->load->library('upload');
$this->load->library('image_lib');
$config['upload_path']          = 'attachments/students/'.$user_name.'/';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['detect_mime']          = TRUE;
$config['remove_spaces']        = TRUE;
$config['encrypt_name']         = TRUE;
$config['max_size']             = '0';
$this->upload->initialize($config);
if (!$this->upload->do_upload('recent_photo')){
  $upload_error = $this->upload->display_errors();
}else{
	$fileData = $this->upload->data();
	$get_form_data['spinfo_photo'] = $fileData['file_name'];
	$configer =  array(
	  'image_library'   => 'gd2',
	  'source_image'    =>  $config['upload_path'].$fileData['file_name'],
	  'create_thumb'    =>  FALSE,
	  'maintain_ratio'  =>  FALSE,
	  'width'           =>  230,
	  'height'          =>  250,
	);
	$this->image_lib->clear();
	$this->image_lib->initialize($configer);
	$this->image_lib->resize();
}