<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_producto" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="prdcod">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="prdcod" id="prdcod" placehoder="Código" value="{{prdcod}}" />
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="prdcod" value="{{prdcod}}" />
      <input type="hidden" name="token" value="{{productos_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="prddsc">Descripcion</label>
      <input class="col-12 col-m-9" {{readonly}} type="text" name="prddsc" id="prddsc" placehoder="Panel" value="{{prddsc}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="prdprc">Precio</label>
      <input class="col-12 col-m-9" {{readonly}} type="number" name="prdprc" id="prdprc" placehoder="Panel" value="{{prdprc}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="prdImgPrm">ImgPrm</label>
      <input class="col-12 col-m-9" {{readonly}} type="" name="prdImgPrm" id="prdImgPrm" placehoder="ImgPrm" value="{{prdImgPrm}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="prdImgScd">ImgScd</label>
      <input class="col-12 col-m-9" {{readonly}} type="" name="prdImgScd" id="prdImgScd" placehoder="ImgScd" value="{{prdImgScd}}" />
    </div>
    
    <div class="row my-4 align-center flex-end">
      {{if showCommitBtn}}
      <button class="primary col-12 col-m-2" type="submit" name="btnConfirmar">Confirmar</button>
      &nbsp;
      {{endif showCommitBtn}}
      <button class="col-12 col-m-2"type="button" id="btnCancelar">
        {{if showCommitBtn}}
        Cancelar
        {{endif showCommitBtn}}
        {{ifnot showCommitBtn}}
        Regresar
        {{endifnot showCommitBtn}}
      </button>
    </div>
    </div>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const btnCancelar = document.getElementById("btnCancelar");
    btnCancelar.addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_productos");
    });
  });
</script>
