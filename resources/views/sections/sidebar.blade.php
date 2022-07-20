 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light"><strong>ASIGNACIÓN DE DESTINOS</strong> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">MENU</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-clipboard"></i>&nbsp;
                        <p>
                            INICIO
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link class="nav-link" to='/'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<p>Habilitaciones</p> </router-link>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fas fa-school"></i>
                        <p>
                            DESTINOS
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-school"></i>
                                    <p>
                                        Elegir Colegio
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                            </a> -->
                            <!-- <ul class="nav nav-treeview"> -->
                                <?php 
                                // $conn = pg_pconnect("host=127.0.0.1 port=5432 dbname=cuaderno_pedagogico user=postgres password=lu12ed29");
                                // $colegios = pg_query($conn,"select * from colegios where col_estado = 1 order by id");
                                //     while($col = pg_fetch_array($colegios)){
                                //         echo '<li class="nav-item">';
                                //         echo '<router-link class="nav-link" to="/opcionColegio/'.$col['id'].'"><i class="fas fa-globe-americas"></i> &nbsp;&nbsp;<p>'.$col['col_abreviatura'].'</p> </router-link>';

                                        // echo '<a href="#" class="nav-link">';
                                        // echo '<p>'.$col['col_abreviatura'].'</p>';
                                        // echo '</a>';
                                    //     echo '</li>';
                                    // }
                                ?>
                            <!-- </ul> -->
                        <!-- </li> -->
                        <li class="nav-item">
                            <!--to='INDICA EL PATH EN ARCHIVO routes.js'-->
                            <router-link class="nav-link" to='/listarPersonal'><i class="fas fa-globe-americas"></i> &nbsp;&nbsp;<p>Personal Destinos</p> </router-link>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fas fa-user-graduate"></i>
                        <p>
                            ACERCA DE
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <router-link class="nav-link" to='/listarEstudiantes'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;<p>Estudiantes</p></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to='/designarEstudiantes'><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;<p>Designación Estudiante</p></router-link>
                        </li> -->
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
