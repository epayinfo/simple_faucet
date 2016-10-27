<?php

// Anti Bot Links 2.00
// by bit.makejar.com NeedIfFindIt https://bitcointalk.org/index.php?action=profile;u=391838
// working demo at http://bit.makejar.com/labs/anti-bot-links-200/
// instructions at http://bit.makejar.com/labs/anti-bot-links-200/install.php

class antibotlinks {
  var $link_count=3;
  var $links_data=array();
  var $link_counter=0;
  var $use_gd=true;
  public function antibotlinks($use_gd=true) {
    $this->use_gd=$use_gd;
  }

  public function generate($link_count=3, $force_regeneration=false) {
    $this->link_count=$link_count;
    if ((!$force_regeneration)&&
        (isset($_SESSION['antibotlinks']))&&
        (is_array($_SESSION['antibotlinks']))&&
        ((isset($_POST['antibotlinks']))||($_SESSION['antibotlinks']['time']>time()-180))) {
      return true;
    }
    if ($this->link_count<3) {
      $this->link_count=3;
    }
    if ($this->link_count>5) {
      $this->link_count=5;
    }
    $word_universe=array();
    $word_universe[]=array('one'=>'1', 'two'=>'2', 'three'=>'3', 'four'=>'4', 'five'=>'5', 'six'=>'6', 'seven'=>'7', 'eight'=>'8', 'nine'=>'9', 'ten'=>'10');
    $word_universe[]=array('1'=>'one', '2'=>'two', '3'=>'three', '4'=>'four', '5'=>'five', '6'=>'six', '7'=>'seven', '8'=>'eight', '9'=>'nine', '10'=>'ten');
   





    $universe_number=mt_rand(0, count($word_universe)-1);
    $universe=$word_universe[$universe_number];

    $antibotlinks_solution='';

    $used_keywords_array=array();

    $antibotlinks_array=array();
    $antibotlinks_array['links']=array();
    for ($z=0;$z<$this->link_count;$z++) {
      $random_number=mt_rand(1000, 9999);
      $antibotlinks_solution.=$random_number.' ';

      // Choose the keyword
      do {
        $keyword=array_rand($universe, 1);
      } while (isset($used_keywords_array[$keyword]));
      $used_keywords_array[$keyword]=1;

      $antibotlinks_array['links'][$z]['link']='<a href="/" rel="'.$random_number.'" class="antibotlinks">Anti-Bot ( <strong>'.$universe[$keyword].'</strong> )</a>';
      $antibotlinks_array['links'][$z]['keyword']=$keyword;
    }

    $info_array=array();
    foreach ($antibotlinks_array['links'] as $link) {
      $info_array[]=$link['keyword'];
    }

    if ($this->use_gd) {
      ob_start();
      $im = imagecreatetruecolor($this->link_count*50, 16);
      $black = imagecolorallocate($im, 0, 0, 0);
      $white = imagecolorallocate($im, 1, 1, 1);
      imagecolortransparent($im, $black);
      imagestring($im, 3, 1, 1, implode(', ', $info_array), $white);
      imagepng($im);
      $imagedata = ob_get_contents();
      ob_end_clean();
      $antibotlinks_array['info']='Please click on the Anti-Bot links in the following order <br><img src="data:image/png;base64,'.base64_encode($imagedata).'" alt="" width="210" height="30"/>';
    } else {
      $antibotlinks_array['info']='Please click on the Anti-Bot links in the following order '.implode(', ', $info_array);
    }

    shuffle($antibotlinks_array['links']);

    $antibotlinks_array['time']=time();
    $antibotlinks_array['solution']=trim($antibotlinks_solution);

    if (!$force_regeneration) {
      $antibotlinks_array['valid']=true;
    }

    $_SESSION['antibotlinks']=$antibotlinks_array;
    return true;
  }

  public function check() { 
    if ((trim($_POST['antibotlinks'])==$_SESSION['antibotlinks']['solution'])&&(!empty($_SESSION['antibotlinks']['solution']))) {
      $_SESSION['antibotlinks']['valid']=true;
    } else {
      $_SESSION['antibotlinks']['valid']=false;
    }	
    return $_SESSION['antibotlinks']['valid'];
  }

  public function show_link() {
    if (!empty($_SESSION['antibotlinks']['links'][$this->link_counter]['link'])) {
		$this->link_counter++;
		return $_SESSION['antibotlinks']['links'][$this->link_counter-1]['link'].'<br />';
    }
    
  }

  public function show_info() {
    return '<p class="alert alert-info">'.$_SESSION['antibotlinks']['info'].'</p>';
  }

  public function is_valid() {
    return $_SESSION['antibotlinks']['valid'];
	
  }

  public function get_link_count() {
    return count($_SESSION['antibotlinks']['links']);
  }

}

?>