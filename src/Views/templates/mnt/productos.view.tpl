<h1>Listado de Productos para el Index</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th>
          <th>prddsc</th>
          <th>prdprc</th>
          <th>prdImgPrm</th>
          <th>prdImgScd</th>
          {{if CanInsert}}
          <th><a href="index.php?page=mnt_producto&mode=INS" class="button">+</a></th>
          {{endif CanInsert}}
    </tr>
  </thead>
  <tbody>
    {{foreach productos}}
    <tr>
      <td>{{rownum}}</td>
      <td>
          {{if ~CanView}}
          <a href="index.php?page=mnt_producto&mode=DSP&id={{prdcod}}">{{prddsc}}</a>
          {{endif ~CanView}}

          {{ifnot ~CanView}}
              {{prddsc}}
          {{endifnot ~CanView}}
      </td>
      <td>{{prdprc}}</td>
      <td>{{prdImgPrm}}</td>
      <td>{{prdImgScd}}</td>
      {{if ~CanView}}
      <td class="center">
        {{if ~CanUpdate}}
        <a href="index.php?page=mnt_producto&mode=UPD&id={{prdcod}}">Editar</a>
        {{endif ~CanUpdate}}
        &nbsp;
        {{if ~CanDelete}}
        <a href="index.php?page=mnt_producto&mode=DEL&id={{prdcod}}">Eliminar</a>
        {{endif ~CanDelete}}
      </td>
      {{endif ~CanView}}
    </tr>
    {{endfor productos}}

  </tbody>
</table>
</section>