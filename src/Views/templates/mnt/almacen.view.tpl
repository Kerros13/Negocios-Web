<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_almacen" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="almacenId">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="almacenId" id="almacenId" placehoder="Código" value="{{almacenId}}" />
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="almacenId" value="{{almacenId}}" />
      <input type="hidden" name="token" value="{{almacenes_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="almacenCodInstitucional">Codigo Institucional del Almacen</label>
      <input class="col-12 col-m-9" {{readonly}} type="text" name="almacenCodInstitucional" id="almacenCodInstitucional" placehoder="Codigo Institucional" value="{{almacenCodInstitucional}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="almacenNombre">Nombre del Almacen</label>
      <input class="col-12 col-m-9" {{readonly}} type="text" name="almacenNombre" id="almacenNombre" placehoder="Panel" value="{{almacenNombre}}" />
    </div>

    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="almacenTipo">Tipo de Almacen</label>
      <select name="almacenTipo" id="almacenTipo" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
          <option value="ARP" {{if almacenTipo_arp}}selected{{endif almacenTipo_arp}}>Almacen de Recepción de Producto</option>
          <option value="ADI" {{if almacenTipo_adi}}selected{{endif almacenTipo_adi}}>Almacén de Distribución</option>
          <option value="ATR" {{if almacenTipo_atr}}selected{{endif almacenTipo_atr}}>Almacén de Transporte</option>
          <option value="ADE" {{if almacenTipo_ade}}selected{{endif almacenTipo_ade}}>Almacén de Despacho</option>
          <option value="ACA" {{if almacenTipo_aca}}selected{{endif almacenTipo_aca}}>Almacén de Canje</option>
      </select>
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="almacenDireccion">Direcciono del Almacen</label>
      <input class="col-12 col-m-9" {{readonly}} type="text" name="almacenDireccion" id="almacenDireccion" placehoder="Panel" value="{{almacenDireccion}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="Latitud">Latitud</label>
      <input class="col-12 col-m-9" {{readonly}} type="number" name="Latitud" id="Latitud" placehoder="Latitud" value="{{Latitud}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="Longitud">Longitud</label>
      <input class="col-12 col-m-9" {{readonly}} type="number" name="Longitud" id="Longitud" placehoder="Longitud" value="{{Longitud}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="almacenEstado">Estado</label>
      <select name="almacenEstado" id="almacenEstado" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
          <option value="OPE" {{if almacenEstado_ope}}selected{{endif almacenEstado_ope}}>OPERATIVO</option>
          <option value="INA" {{if almacenEstado_ina}}selected{{endif almacenEstado_ina}}>INACTIVO</option>
          <option value="ENC" {{if almacenEstado_enc}}selected{{endif almacenEstado_enc}}>EN CIERRE</option>
          <option value="ENL" {{if almacenEstado_enl}}selected{{endif almacenEstado_enl}}>EN LITIGIO</option>
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
      window.location.assign("index.php?page=mnt_almacenes");
    });
  });
</script>
