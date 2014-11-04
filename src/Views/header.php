<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ooops, something went wrong!</title>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
        <?php
            require (dirname(__DIR__).'/css/main.css');
            require (dirname(__DIR__).'/css/prism.css');
        ?>
    </style>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script>
        <?php
            require (dirname(__DIR__).'/js/prism.js');

            require (dirname(__DIR__).'/js/main.js');
        ?>
    </script>
</head>
<body>

    <div class="wrap">
        
        <div class="left-panel">
           <?php foreach( $trace as $action ){ ?>
            
            <div class="left-panel-stack">
                
                <p class="stack-function">
                    <?php if(isset($action['line'])){ ?>
                        <b class="stack-text-bolder" style="float:left;display:inline-block;width:25px;"><i><?=$action['line']?></i></b> 
                    <?php }else{ ?>
                        <b class="stack-text-bolder" style="float:left;display:inline-block;width:25px;height:10px;"><i></i></b> 
                    <?php } ?>
                <?=$action['function']?> <span class="fa fa-angle-down"></span></p>
                
                <div class="stack-slideable">
                    
                    <?php if(isset($action['file'])){ ?>
                    <p class="stack-class">
                        <span class="stack-text-bolder">File:</span> 
                        <i><small><?=$action['file']?></small></i>
                    </p>
                    <?php } ?>
                    

                    
                    <?php if(isset($action['class'])){ ?>
                    <p class="stack-class">
                        <span class="stack-text-bolder">Class:</span> 
                        <i><small><?=$action['class']?></small></i>
                    </p>
                    <?php } ?>
                                        
                    <?php if(!empty($action['args'])){ ?>
                    <p class="stack-class">
                        
                        <?php 
                        
                        echo '<span class="stack-text-bolder">Arguments:</span> ';
            
                        foreach( $action['args'] as $num => $arg ){ 
                               if( is_string($arg)){
                                   if(!empty($arg)){
                                      echo "<p> <small> $num: $arg  </small></p>";
                                   }
                               }else if(is_array($arg)){
                                $vals = [];
                                    ob_start();
                                        foreach ($arg as $key => $value) {
                                            ob_start();
                                                 print_r($value);
                                            array_push($vals, ob_get_clean());
                                        }
                                    $arr = ob_get_clean();
                                    $count = 0;
                                   foreach ($vals as $v) {
                                        $count++;
                                        if(!empty($v)){
                                            echo "<p style=''> <small>$count: $v</small> </p>";
                                        }
                                   }
                               }else{
                                    echo " - ";
                               }
                        } ?>
                    </p>
                    <?php } ?>
                    
                </div>
                
                 
            </div>
            
            <?php } ?>
        </div>  
        
        <div class="main-panel">
            <div class="main-panel-inner">
                
                <div class="main-pannel-info">
                    <p class="main-pannel-info-message"><?=$message?>, on line <?=$line?></p>
                    <p class="main-pannel-info-file"><?=$file?></p>
                    <p class="execinfo">
                        <span style="padding-right:5px">Time: <b><?=(round((microtime(true) - $GLOBALS['execution_time']) * 1000, 2))?> </b>ms</span>
                        Memmory: <b><?=(memory_get_peak_usage(true) / 1024 / 1024)?> </b>MB
                    </p>
                </div>
                
                <div class="main-panel-code">
                    <?php
                        $content = file($file);
                    ?>
                    <?php
$lineNum = 0;
$output = '';
$outputted=0;
foreach ($content as $cl) {
    $lineNum++;
    
    if($lineNum >= $line-5 && $lineNum <= $line+5 ){
        $outputted++;
        $output .= $cl;
    }
}
?>

<pre class="line-numbers " data-start="<?php if($line > 5){echo $line-5;}else{echo 1;} ?>" 
data-line="<?php if($line > 5){echo 6;}else{echo $line;} ?>"><code class="language-php codestart"><?php
echo htmlspecialchars($output);
while($outputted <= 10){
    echo PHP_EOL;
    $outputted++;
}
?>
</code></pre>
                </div>
                
                <div class="main-panel-details">
                    <div class="main-panel-details-block">
                        <p><b>POST:</b> <span class="fa fa-angle-down"></span></p>
<pre class=><?php  if(empty($_POST)) echo 'empty'; else print_r($_POST); ?></pre>
                    </div>
                    <div class="main-panel-details-block">
                        <p><b>GET:</b> <span class="fa fa-angle-down"></span></p>
<pre class=><?php  if(empty($_GET)) echo 'empty'; else print_r($_GET); ?></pre>
                    </div>
                    <div class="main-panel-details-block">
                        <p><b>SESSION:</b> <span class="fa fa-angle-down"></span></p>
<pre class=><?php  if(empty($_SESSION)) echo 'empty'; else print_r($_SESSION); ?></pre>
                    </div>
                    <div class="main-panel-details-block">
                        <p><b>COOKIE:</b> <span class="fa fa-angle-down"></span></p>
<pre class=><?php  if(empty($_COOKIE)) echo 'empty'; else print_r($_COOKIE); ?></pre>
                    </div>
                    <div class="main-panel-details-block">
                        <p><b>SERVER:</b> <span class="fa fa-angle-down"></span></p>
<pre class=><?php  
foreach($_SERVER as $key => $value){
    if(is_string($value)){
        echo "<b style='color:rgba(30, 32, 33, 0.58)'>$key:</b> $value <br>";
    }
}
?></pre>
                    </div>


                    </div>

                </div>
                
            </div>
        </div>
        
        
    </div>
	
    <style>
        <?php
            require (dirname(__DIR__).'/css/highlighter.css');
        ?>
    </style>
	