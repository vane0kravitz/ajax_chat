<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 18:40
 */

namespace app\views;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../web/css/main.css"  rel="stylesheet" type="text/css">
    <title>ajaxComments</title>
</head>
<body>


<div class="wrapper row1">
    <header id="header" class="clear">
        <div id="hgroup">
            <h1><a href="/web/main/">ajaxComments</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="/web/main/">Home</a></li>
                <li class="last"><a href="/web/main/docs/">Docs</a></li>
            </ul>
        </nav>
    </header>
</div>


<!-- content -->
<div class="wrapper row2">
    <div id="container" class="clear">
        <!-- content body -->
        <section id="shout">
            <p><?= $title ?></p>
        </section>
        <!-- main content -->
        <div id="homepage">
            <section id="latest">
                <article>
                    <figure>
                        <h3>1) Add to you html:</h3>
                        <br>
                        <math>
                            <![CDATA[
                                <iframe src="http://javascript.info">
                                    <ul class="results">
                                        <!-- append -->
                                    </ul>
                                </iframe>
                            ]]> 
                        </math>
                    </figure>
                    <hr>
                    <figure>
                        <h3>2) Add to you js lists:</h3>
                        <br>
                        <math>
                            <![CDATA[
                                <script type="text/javascript">
                                    var userip;
                                </script>
                                <script type="text/javascript" src="https://l2.io/ip.js?var=userip"></script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                                <script src="http://ajaxcomments/web/js/main.js"></script>
                            ]]> 
                        </math>
                    </figure>
                </article>
            </section>
        </div>
        <!-- / content body -->
    </div>
</div>

<!-- Footer -->
<div class="wrapper row3">
    <footer>
        <p>vane0kravitz</p>
    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../../web/js/main.js"></script>
</body>
</html>