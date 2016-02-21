<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 19:26
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
            <p>very simple html css</p>
        </section>
        <!-- main content -->
        <div id="homepage">
            <section id="latest">
                <article>
                    <figure>
                        <ul>
                            <li>comment 1</li>
                            <li>comment 2</li>
                            <li>comment 3</li>
                        </ul>

                        <div class="form-block">
                            <form>
                                <input type="text" name="field1" placeholder="First Name" />
                                <input type="text" name="field2" placeholder="Last Name" />
                                <textarea name="field3" placeholder="Type your Comment"></textarea>
                                <input type="submit" value="Send" />
                            </form>
                        </div>
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




