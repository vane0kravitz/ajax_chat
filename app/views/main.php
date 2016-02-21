<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 19:26
 */

namespace app\views;

if(isset($_POST) && !empty($_POST['data'])) {
    var_dump(json_decode($_POST['data']));

    die();
}

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
                        <ul class="results">
                            <!-- append -->
                        </ul>
                        <div class="form-block">
                            <form id="commentForm">
                                <input type="text" name="fname" id="fname" placeholder="First Name" />
                                <input type="text" name="lname" id="lname" placeholder="Last Name" />
                                <textarea name="comment" id="comment" placeholder="Type your Comment"></textarea>
                                <input type="button" id="send-button" value="Send" />
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

<script type="text/javascript">
    var userip;
</script>
<script type="text/javascript" src="https://l2.io/ip.js?var=userip"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="../../web/js/main.js"></script>
</body>
</html>




