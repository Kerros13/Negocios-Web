<h1>Listado de Pianos para el Index</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th>
          <th>pianodsc</th>
          <th>pianobio</th>
          <th>pianosales</th>
          <th class="hidden-s">pianoimguri</th>
          <th class="hidden-s">pianoimgthb</th>
          <th>pianoprice</th>
          <th>pianoest</th>
          <th><a href="index.php?page=mnt_piano&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach pianos}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=mnt_piano&mode=DSP&id={{pianoid}}">{{pianodsc}}</a></td>
      <td>{{pianobio}}</td>
      <td>{{pianosales}}</td>
      <td class="hidden-s">{{pianoimguri}}</td>
      <td class="hidden-s">{{pianoimgthb}}</td>
      <td>{{pianoprice}}</td>
      <td>{{pianoest}}</td>
      <td class="center">
        <a href="index.php?page=mnt_piano&mode=UPD&id={{pianoid}}">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_piano&mode=DEL&id={{pianoid}}">Eliminar</a>
      </td>
    </tr>
    {{endfor pianos}}

  </tbody>
</table>
</section>