<section class="content-header">
  <h1><i class="fa fa-users icon-title"></i> Gestión de Usuarios
    <a class="btn btn-primary btn-sm pull-right" href="?module=form_user&form=add"><i class="fa fa-plus"></i> Agregar Usuario</a>
  </h1>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <table id="dataTables1" class="table table-bordered table-striped">
        <thead>
          <tr><th>ID</th><th>Usuario</th><th>Nombre</th><th>Nivel</th><th>Estado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $q = mysqli_query($mysqli, "SELECT * FROM usuarios ORDER BY id_user DESC");
          while ($d = mysqli_fetch_assoc($q)) {
              $btn_status = ($d['status'] == 'activo')
                  ? "<a class='btn btn-warning btn-xs' href='modules/user/proses.php?act=off&id=$d[id_user]' title='Bloquear'><i class='fa fa-ban'></i></a>"
                  : "<a class='btn btn-success btn-xs' href='modules/user/proses.php?act=on&id=$d[id_user]' title='Activar'><i class='fa fa-check'></i></a>";
              echo "<tr>
                      <td>$d[id_user]</td>
                      <td>$d[username]</td>
                      <td>$d[name_user]</td>
                      <td>$d[permisos_acceso]</td>
                      <td>$d[status]</td>
                      <td>
                        $btn_status
                        <a class='btn btn-primary btn-xs' href='?module=form_user&form=edit&id=$d[id_user]'><i class='fa fa-edit'></i></a>
                      </td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
