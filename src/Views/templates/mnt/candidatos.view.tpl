<h1>Listado de Candidatod para el Index</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th>
          <th>candidato_identidad</th>
          <th>candidato_nombre</th>
          <th>candidato_edad</th>
          <th><a href="index.php?page=mnt_candidato&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach candidatos}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=mnt_candidato&mode=DSP&id={{candidato_id}}">{{candidato_identidad}}</a></td>
      <td>{{candidato_nombre}}</td>
      <td>{{candidato_edad}}</td>
      <td class="center">
        <a href="index.php?page=mnt_candidato&mode=UPD&id={{candidato_id}}">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_candidato&mode=DEL&id={{candidato_id}}">Eliminar</a>
      </td>
    </tr>
    {{endfor candidatos}}

  </tbody>
</table>
</section>