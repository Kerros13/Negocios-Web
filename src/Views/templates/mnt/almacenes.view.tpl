<h1>Listado de Almacenes para el Index</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th>
          <th>almacenCodInstitucional</th>
          <th>almacenNombre</th>
          <th>almacenTipo</th>
          <th>almacenDireccion</th>
          <th>Latitud</th>
          <th>Longitud</th>
          <th>almacenEstado</th>
          <th><a href="index.php?page=mnt_almacen&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach almacenes}}
    <tr>
      <td>{{rownum}}</td>
      <td>{{almacenCodInstitucional}}</td>
      <td><a href="index.php?page=mnt_almacen&mode=DSP&id={{almacenId}}">{{almacenNombre}}</a></td>
      <td>{{almacenTipo}}</td>
      <td>{{almacenDireccion}}</td>
      <td>{{Latitud}}</td>
      <td>{{Longitud}}</td>
      <td>{{almacenEstado}}</td>
      <td class="center">
        <a href="index.php?page=mnt_almacen&mode=UPD&id={{almacenId}}">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_almacen&mode=DEL&id={{almacenId}}">Eliminar</a>
      </td>
    </tr>
    {{endfor almacenes}}

  </tbody>
</table>
</section>