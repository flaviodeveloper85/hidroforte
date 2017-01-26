<div class="ism-slider" data-play_type="loop" data-image_fx="zoompan" id="my-slider">
              <ol>
                <li>
                  <img src="<?php echo base_url('img/00.jpg');?>" alt="Banheiras de Hidro" />
                  <div class="ism-caption ism-caption-0">HIDRO FORTE - Banheiras de Hidromassagem, Ofurô, Spas e Acessórios</div>
                </li>
                <li>
                  <img src="<?php echo base_url('img/01.jpg');?>" alt="Temos os melhores preços" />
                  <div class="ism-caption ism-caption-0">Os Melhores Preços. Tudo a Pronta Entrega!</div>
                </li>
                <li>
                  <img src="<?php echo base_url('img/02.jpg');?>" alt="Projetos em deck de madeira">
                  <div class="ism-caption ism-caption-0">Projetos em Deck de Madeira</div>
                </li>
              </ol>
    </div>
    <div class="container-fluid index">
        <div class="container">
                <div class="container-modal-prod" id="container-modal-prod">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="" id="img_prod" width="387" height="387" alt="produto"/>
                            </div>
                            <div class="col-lg-6 info-prod">
                                <i class="fa fa-times fa-2x" id="close_modal" aria-hidden="true" ></i>
                                <h1 class="title-prod" id="title_prod"></h1>
                                <div class="box-config" id="box_config"></div>
                                <span class="title-opc">opcionais</span>
                                <div class="box-opcionais" id="box_opcionais"></div>
                                <a class="btn-sm btn-default bt-prod-orc" href="<?php echo site_url(); ?>contato">Solicite Orçamento</a>
                            </div>
                        </div>
                </div> 
            <div class="col-lg-12">
            <h1 class="h1-products">PRODUTOS EM DESTAQUE</h1>
            <?php foreach($produtos_home as $prods): ?>

            <div class="products" onclick="info_prod(<?php echo $prods->id; ?>)">
                <img src="<?php echo base_url('img/uploads/');?><?php echo $prods->imagem?>" width="200" height="200" alt="produtos hidro forte">
                <h2><?php echo $prods->produto; ?></h2>
                <p class="pronta-e">
                Pronta Entrega!<br />
                <?php if($prods->show_preco == 's'): ?>
                <span class="preco-prod">* R$ <?php echo number_format($prods->preco, 2, ',', '.'); ?> *</span>
                <?php endif; ?>
                </p>
                
            </div>
        <?php endforeach; ?>

            
        </div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            <?php foreach($deps as $dep): ?>
                <!-- div depoimentos -->
        <div class="box-dep">
            <i class="fa fa-check-square" aria-hidden="true" ></i>
            <?php echo $dep->nome." ".$dep->sobrenome; ?> - <?php echo $dep->cidade; ?> / <?php echo $dep->estado; ?> <br />
            <span class="msg-dep">"<?php echo $dep->mensagem; ?>"</span>
        </div>
            <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                
            </div>
        </div>
        
    </div>
<script>
    
    $(function(){

        $('#close_modal').click(function(){
            $('.container-modal-prod').toggle();
        });
    });

    function info_prod(id){

        var cod_item = id;

        $.ajax({
            // reutilizo o metodo popular_modal_edit() para resgatar as informaçoes dos produtos no bd
          url: "<?php echo site_url(); ?>products/popular_modal_edit",
          type: "POST",
          data: { cod_item: cod_item},
          dataType: "html",
          success: function(result){
               
               var data = JSON.parse(result);
                
                var path_img = "<?php echo base_url(); ?>img/uploads/" + data.imagem;
                $('#img_prod').attr('src', path_img);
                $('#title_prod').html(data.produto);
                $('#box_config').html(data.config);
                $('#box_opcionais').html(data.opcional);
              
          } 
        }); 
        
        $('#container-modal-prod').toggle( "bounce", { times: 3 }, "slow" );

    }
</script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'ibP7E45RRC';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
