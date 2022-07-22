<?php
    class viewCounter extends Plugin {
       
        public function init()
    {

        $this->dbFields = array(
			'fontcolor'=>'',
		'background'=>'',
        'fontsize'=>'',
        'visitors'=>'',
		);


        $this->customHooks = array(
            'showCounter'
        );
    }


    public function siteHead(){
        setcookie("viewCounter", 'true', time()+(60*60*24*90)); 
    }


    public function showCounter(){



        if($this->getValue('visitors')==='all'){

            $viewsCounter = file_get_contents($this->phpPath().'counter.txt') + 1;
            file_put_contents($this->phpPath().'counter.txt',  $viewsCounter);
            echo '<div style="display:inline; box-sizing:border-box;padding:5px;font-size:'.$this->getValue('fontsize').';color:'.$this->getValue('fontcolor').';background:'.$this->getValue('background').'" class="views-counter">'.$viewsCounter.'</div>';
        
        }






        if($this->getValue('visitors')==='unique'){

    
        if (isset($_COOKIE["viewCounter"])) {
            $viewsCounter = file_get_contents($this->phpPath().'counter.txt');
            echo '<div style="display:inline; box-sizing:border-box;padding:5px;font-size:'.$this->getValue('fontsize').';color:'.$this->getValue('fontcolor').';background:'.$this->getValue('background').'" class="views-counter">'.$viewsCounter.'</div>';
        
        }else{
            $viewsCounter = file_get_contents($this->phpPath().'counter.txt') + 1;
            file_put_contents($this->phpPath().'counter.txt',  $viewsCounter);
            $newCounter = file_get_contents($this->phpPath().'counter.txt');
            echo '<div style="display:inline; box-sizing:border-box;padding:5px;font-size:'.$this->getValue('fontsize').';color:'.$this->getValue('fontcolor').';background:'.$this->getValue('background').'" class="views-counter">'.$newCounter.'</div>';
        };

    }




    }


    public function form(){

        $viewsCounter = file_get_contents($this->phpPath().'counter.txt');


        $html = "
        <div class='bg-light border p-3'>
        Put <code> &#60;?php Theme::plugins('showCounter'); ?&#62; </code> on your template when you want show counter (this View counter count every unique visitors )
        </div>
     <br>
        <p>Change start count number</p>
        <input type='text' placeholder='' name='newnumber' value='$viewsCounter'>
        <br>

        <p>Font color</p>
        <input type='color' name='fontcolor'  class='form-control form-color' value='".$this->getValue('fontcolor')."'>
        <br>

        <p>Background counter</p>
        <input type='color' name='background' class='form-control form-color' value='".$this->getValue('background')."'>
     
     <br>
        <p>Font size</p>
        <input type='text' name='fontsize' placeholder='13px' class='form-control' value='".$this->getValue('fontsize')."'>
        <br>

        <p>Show what count visits</p>
        <select name='visitors'>
<option value='unique' ".($this->getValue('visitors')==="unique"?"selected":"").">Unique visitors</option>
<option value='all' ".($this->getValue('visitors')==="all"?"selected":"").">All visitors</option>
        </select>

        
        <div class='bg-danger text-light col-md-12 mt-5 py-3 d-block border text-center'>

      
        <p class='lead'>Created by <b>multicolor</b> | Buy me coffe ❤️  </p>

        <a href='https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72'>
        <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif'  />
        </a>

        </div>

   
        ";
        return $html;

    }


    public function post(){

        $newNumbers = $_POST['newnumber'];
        file_put_contents($this->phpPath().'counter.txt', $newNumbers);
        parent::post();

    }


    }
?>