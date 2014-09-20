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
           <?php foreach( debug_backtrace() as $action ){ ?>
            
            <div class="left-panel-stack">
                
                <p class="stack-function"><?=$action['function']?> <span class="fa fa-angle-down"></span></p>
                
                <div class="stack-slideable">
                    
                    <?php if(isset($action['file'])){ ?>
                    <p class="stack-class">
                        <span class="stack-text-bolder">File:</span> 
                        <i><?=$action['file']?></i>
                    </p>
                    <?php } ?>
                    
                    <?php if(isset($action['line'])){ ?>
                    <p class="stack-class">
                        <span class="stack-text-bolder">Line:</span> 
                        <i><?=$action['line']?></i>
                    </p>
                    <?php } ?>
                    
                    <?php if(isset($action['class'])){ ?>
                    <p class="stack-class">
                        <span class="stack-text-bolder">Class:</span> 
                        <i><?=$action['class']?></i>
                    </p>
                    <?php } ?>
                                        
                    <?php if(!empty($action['args'])){ ?>
                    <p class="stack-class">
                        
                        <?php 
                        
                        echo '<span class="stack-text-bolder">Arguments:</span> ';
            
                        foreach( $action['args'] as $num => $arg ){ 
                               if( is_string($arg)){
                                   echo "<p> $num: $arg </p>";
                               }else{
                                   echo "<p> $num: Array </p>";
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
                    <pre class="line-numbers " data-start="<?=$line-9?>" data-line="9"><code class="language-php codestart"><?php
                        
$outputtedLines = 0;
$currentLine = 0;

foreach($content as $fileLine){
    $currentLine++;
    if($currentLine >= $line - 9 ){
        if($outputtedLines > 18) break;
        $outputtedLines++;
        echo htmlspecialchars($fileLine);
    }
    
}
?></code></pre>
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
    echo "<b style='color:rgba(30, 32, 33, 0.58)'>$key:</b> $value <br>";
}
?></pre>
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
	