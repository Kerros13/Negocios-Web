<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_piano" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianoid">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="pianoid" id="pianoid" placehoder="Código" value="{{pianoid}}" />
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="pianoid" value="{{pianoid}}" />
      <input type="hidden" name="token" value="{{pianos_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianodsc">Descripcion del Piano</label>
      <input class="col-12 col-m-9" {{readonly}} type="text" name="pianodsc" id="pianodsc" placehoder="Panel" value="{{pianodsc}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianobio">Biografia del Piano</label>
      <input class="col-12 col-m-9" {{readonly}} type="text" name="pianobio" id="pianobio" placehoder="Panel" value="{{pianobio}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianosales">Descuento del Piano</label>
      <input class="col-12 col-m-9" {{readonly}} type="number" name="pianosales" id="pianosales" placehoder="Panel" value="{{pianosales}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianoimguri">Url Imágen</label>
      <input class="col-12 col-m-9" {{readonly}} type="" name="pianoimguri" id="pianoimguri" placehoder="Url Imágen" value="{{pianoimguri}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianoimgthb">Html a Mostrar el Piano</label>
      <input class="col-12 col-m-9" {{readonly}} type="" name="pianoimgthb" id="pianoimgthb" placehoder="Html en Piano" value="{{pianoimgthb}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianoprice">Precio a Mostrar</label>
      <input class="col-12 col-m-9" {{readonly}} type="number" name="pianoprice" id="pianoprice" placehoder="" value="{{pianoprice}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="pianoest">Estado</label>
      <select name="pianoest" id="pianoest">
          <option value="ACT" {{if pianoest_act}}selected{{endif pianoest_act}}>Mostrar</option>
          <option value="INA" {{if pianoest_ina}}selected{{endif pianoest_ina}}>Ocultar</option>
      </select>
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
      window.location.assign("index.php?page=mnt_pianos");
    });
  });
</script>
