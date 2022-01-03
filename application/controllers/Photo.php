<?php

use TT\BaseController;
use TT\TinyThumb;

require_once __DIR__ . '../../src/bootstrap.php';

class Photo extends BaseController
{

    protected $moduleName = 'evaluations';


    public function __construct()
    {
        global $oSmarty;
        parent::__construct($oSmarty);
        $auth = $this->check($this->userConnected, $this->agent);
    }

    public function resize(){
        $width  = 75;
        $height = 75;
        $src   = $_GET['src'];
        $cache_dest  = APPPATH . 'cache/.user_thumb';
        if ( !is_dir($cache_dest) ){
            @mkdir($cache_dest, 0777);
        }
        $filename  = md5($src) . '.' . pathinfo($src, PATHINFO_EXTENSION) ;
        $resized_image = $cache_dest . '/' . $filename;
        if ( !file_exists($resized_image) ){
            $this->do_resize($src, $resized_image, $width, $height);
        } else {
            list ( $w, $h ) = getimagesize(dirname(APPPATH) . $src);
            if ( $w != $width or $h != $height ){
                $this->do_resize($src, $resized_image, $width, $height);
            }
        }
        /*echo 'data:image/' . pathinfo($src, PATHINFO_EXTENSION).';base64,'.base64_encode(
            file_get_contents($resized_image)
            );*/
        //imagejpeg($resized_image);
        /*header('Content-Type: image/jpeg');
        header('Content-Length: '.filesize($resized_image));
        readfile($resized_image);*/
        /*$this->load->helper('file');
        $this->output->set_content_type(get_mime_by_extension($resized_image))
            ->set_output(file_get_contents($resized_image));*/
        //$this->output->set_output(file_get_contents($resized_image));


    }

    private function do_resize($src, $dest, $w, $h){
        $config = [];
        $config['image_library'] = 'gd2';
        $config['source_image'] = dirname(APPPATH) . $src;
        $config['maintain_ratio'] = false;
        $config['width'] = $w;
        $config['height'] = $h;
        $config['new_image'] = $dest;

        $this->load->library('image_lib', $config);
        //echo '<pre>', print_r($this->image_lib), '</pre>', exit;
        $this->image_lib->resize();
    }

}