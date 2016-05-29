<footer class="blog-footer">
    <p>© COPYRIGHT © 2016.FREDDON ALL RIGHTS RESERVED.<a href="#"><?= $map['back2top'][$lang]?></a></p>
    <div class="btn-group dropup">
        <p class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $map['lang'][$lang]?><span class="caret"></span>
        </p>
        <ul class="dropdown-menu lang-switch">
            <li><a href="javascript:;" data-value="zh"><?= $map['lang']['zh']?></a></li>
            <li><a href="javascript:;"  data-value="en"><?= $map['lang']['en']?></a></li>
            <li><a href="javascript:;"  data-value="jp"><?= $map['lang']['jp']?></a></li>
        </ul>
    </div>
</footer>
<script>
    $(document).ready(function(){
        var lang=sessionStorage.getItem('lang');
        $('.lang-switch li a').click(function(event){
            var choseLang=event.target.getAttribute('data-value');
            if(lang!=choseLang){
                sessionStorage.setItem('lang',choseLang);
                envir.setCookie('lang',choseLang);
            }
            envir.httpProxy.ajax('/lang',{'lang':choseLang},'POST',
                function(xhr,res,o){
                    location.reload();
                },
                function(xhr,res,o){}
            );
        });
    });

</script>