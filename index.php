<?php
include("FileManager.php");
include("options.php");
?>
<!Doctype html>
<html>
<head>
    <title>List of cards!</title>
    <meta charset="UTF-8">
    <?php include('outfit.php'); ?>
</head>
<body>

<div class="container">

    <nav class="navbar navbar-default center navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">

            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>


        </div>

        <!-- Collection of nav links and other content for toggling -->

        <div id="navbarCollapse" class="collapse navbar-collapse">

            <ul class="nav navbar-nav">
                <?php
                foreach($lang_list as $key=>$val)
                {
                    print ("<li><a class='btn language' href='index.php?lang=".$val."'>".$key."</a></li>");
                }
                ?>

            </ul>
        </div>
        </div>

    </nav>
    <div class="cards container">
    </div>
    <div class="status">
    </div>
    <div class="update">

        <?php
        $manager = new FileManager();
        if(!isset($_GET['lang']))
            $_GET['lang']='en-US';
        $list = $manager->readFile($listPath, $_GET['lang']);
        if(empty($list))
            {
               ?>
                <script>
                    $('.status').load("first.php");
                    $('.update').load('update_cardlist.php?lang=<?php print $_GET['lang']; ?>');
                </script>
                <?php
            }
        else
        {
        ?><script>
            $('.cards').load('cards.php?lang=<?php print $_GET['lang']; ?>');
        </script>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>