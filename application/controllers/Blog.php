<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
  public function index()
  {
    $this->load->library('parser');

    $user = $this->db->get('user')->result_array();

    $data = array(
      'blog_title' => 'My Blog Title',
      'blog_heading' => 'My Blog Heading',
      'blog_entries' => array(
        array('title' => 'Title 1', 'body' => 'Body 1'),
        array('title' => 'Title 2', 'body' => 'Body 2'),
        array('title' => 'Title 3', 'body' => 'Body 3'),
        array('title' => 'Title 4', 'body' => 'Body 4'),
        array('title' => 'Title 5', 'body' => 'Body 5')
      )
    );

    $this->parser->parse('blog', $data);
  }
}
