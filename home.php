<div class="container">
    <div class="row" id="main-wrapper">
        <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="list-group">
                <?php
                    $opt = isset($_GET["opt"])?$_GET["opt"]:"0";
                ?>
                <a href="?opt=0" class="list-group-item <?php echo $opt=="0"?'active':'';?>">Home</a>
                <a href="?opt=3" class="list-group-item <?php echo $opt=="3"?'active':'';?>">Mi Perfil</a>
            </div>            
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9">
            <?php switch ($opt){
                case "0":{
                        echo "Home";
                    break;}
                case "3":{
                        include_once 'block/perfil.php';
                    break;}
            }?>
            
            
        </div>
    </div>
</div>