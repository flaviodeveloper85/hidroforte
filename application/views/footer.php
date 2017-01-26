        <div class="overlay"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 footer">
                    <div class="col-lg-4 col-md-5 col-sm-5 contact">
                        <nav>
                            <ul>
                                <li><a data-toggle="modal" data-target="#modal_local">Localização</a></li>
                                <li><a href="<?php echo site_url();?>contato">Contato (orçamento)</a></li>
                                <li>Tel (11) 6305-6502 / 6305-6503</li>
                                <li>Rua José dos Reis, 45 - Vila Prudente São Paulo/SP</li>
                            </ul>
                        </nav>
                        
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-3 credit">
                        <ul class="">
                            <li><i class="fa fa-facebook-square fa-2x" aria-hidden="true" title="Visite nosso facebook"></i></li>
                            <li><i class="fa fa-copyright"></i> HIDRO FORTE <?php echo date('Y'); ?></li>
                            <li><a href="http://facebook.com.br/flaviosantosweb">Desenvolvido by FS Denvolvimento Web</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 info">
                        <ul>
                            <li>
                                <img src="<?php echo base_url('img/todo-brasil.png');?>" width="232" height="164">        
                            </li>
                            <li><img src="<?php echo base_url('img/band.jpg');?>" width="245" height="32"></li>
                        </ul>
                        
                    </div>
                </div>
            </div>    
        </div>
        
        <!-- Modal -->
<div id="modal_local" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hidro Forte - Rua José dos Reis, 45 - Vila Prudente</h4>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url();?>img/map.jpg" class="img-responsive" alt="mapa de localizaçao">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
        
    </body>
<script src="<?php echo base_url('js/jquery.cycle.js');?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js');?>"></script>
</html>
<script>
    
    $(function(){
        //
        $('#trigger_loc').click(function(){
            $('.overlay').addClass('bg-overlay');
            $('#modal_localizacao').toggle("explode");
        });

        //fecha modal localizaçao
        $('#close_loc').click(function(){
            $('#modal_localizacao').toggle();
        });
    });
</script>