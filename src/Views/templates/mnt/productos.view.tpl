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
          <th><a href="index.php?page=mnt_producto&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach productos}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=mnt_producto&mode=DSP&id={{prdcod}}">{{prddsc}}</a></td>
      <td>{{prdprc}}</td>
      <td>{{prdImgPrm}}</td>
      <td>{{prdImgScd}}</td>
      <td class="center">
        <a href="index.php?page=mnt_producto&mode=UPD&id={{prdcod}}">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_producto&mode=DEL&id={{prdcod}}">Eliminar</a>
      </td>
    </tr>
    {{endfor productos}}

  </tbody>
</table>
</section>