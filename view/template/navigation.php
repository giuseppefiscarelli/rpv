<?php
    $numLinks = getConfig('numLinkNavigator', 4);

?>
<div class="row">

<div class="col-md-12">
            <ul class="pagination pagination-round pagination-outline-danger pagination-sm flex-sm-wrap" style="justify-content: center;">
            <li class="page-item<?= $page ==1 ?' disabled':'' ?> ">
                <a class="page-link" href="<?="$pageUrl?$navOrderByQueryString&page=".($page-1)?>">Pre</a></li>
            
            
                <?php
                $startValue = $page - $numLinks;
                    $startValue = $startValue < 1 ? 1 : $startValue;
                    for($i =$startValue;$i<$page;$i++):?>
                    <li class="page-item">
                        <a class="page-link" href="<?="$pageUrl?$navOrderByQueryString&page=$i"?>"><?=$i?></a></li>

                <?php
                    endfor;
                ?>
                    
                <li class="page-item active">
                    <a class="page-link disabled"  style="cursor:default;"><?=$page?></a></li>
    
                <?php
                    $startValue = $page + 1;
                    $startValue = $startValue < 1 ? 1 : $startValue;
                    $endValue = ($page + $numLinks);
                    $endValue = min($endValue,$numPages);

                    for($i =$startValue;$i<=$endValue;$i++):?>
                    <li class="page-item">
                        <a class="page-link" href="<?="$pageUrl?$navOrderByQueryString&page=$i"?>"><?=$i?></a></li>

                <?php
                    endfor;
                ?>
            <li class="page-item<?= $page ==$numPages ?' disabled':'' ?>"><a class="page-link " href="<?="$pageUrl?$navOrderByQueryString&page=".($page+1)?>">Succ</a></li>
            </ul>
</div>
</div>
