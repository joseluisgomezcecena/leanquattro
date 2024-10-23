<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown" <?php echo ($active == 'home') ? "style='background-color: rgba(3, 252, 102, .45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> >
                <a class="dropdown-toggle" href="<?php echo base_url(); ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-home"></i>
                    </span>
                    <span class="title">Inicio</span>
                </a>
            </li>
            <!--
            <li <?php echo ($active == 'workorders') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item active ">
                <a class="dropdown-toggle" href="<?php echo base_url(); ?>workorders">
                    <span class="icon-holder">
                        <i class="anticon anticon-file"></i>
                    </span>
                    <span class="title">Ordenes De Trabajo</span>
                </a>
            </li>
-->
            <li <?php echo ($active == 'projects') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-alert"></i>
                    </span>
                    <span class="title">Andon</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>andon/client">Aplicación de reportes</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>andon/support/">Aplicación de soporte</a>
                    </li>
                </ul>
            </li>



            <li <?php echo ($active == 'workstations') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-file"></i>
                    </span>
                    <span class="title">Ordenes Por Hora</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() //planning/single/list ?>planning/list">Lista De Ordenes</a>
                    <li>
                        <a href="<?php echo base_url() //planning/single/create ?>planning/create/">Planear Ordenes</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>production/single/scan">Capturar Orden</a>
                    </li>
                </ul>
            </li>
            
            
            <li <?php echo ($active == 'workstations') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-clock-circle"></i>
                    </span>
                    <span class="title">Hora Por Hora</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() //planning/multiple/list ?>workorders/hourbyhour/">Lista De Ordenes</a>
                    <li>
                        <a href="<?php echo base_url() //planning/multiple/create ?>workorders/hourbyhour/create/">Planear Ordenes</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() //production/multiple/menu ?>floor/hourbyhour/">Capturar Avance</a>
                    </li>
                </ul>
            </li>

            <!--
            
            <li <?php echo ($active == 'parts') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-tool"></i>
                    </span>
                    <span class="title">Numeros De Parte</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>parts/create">Nuevo Numero De Parte</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>parts/">Lista</a>
                    </li>
                </ul>
            </li>

-->

<!--

            <li <?php echo ($active == 'clients') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-solution"></i>
                    </span>
                    <span class="title">Clientes</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>clients/create">Registrar Cliente</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>clients/">Ver Lista</a>
                    </li>
                </ul>
            </li>
-->
            <!--
            <li <?php echo ($active == 'operations') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Operaciones o Procesos</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>operations/create">Registrar Proceso</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>operations/">Ver Lista</a>
                    </li>
                </ul>
            </li>
            -->

            
            <?php if ($this->session->userdata('is_admin')): ?>
                <li <?php echo ($active == 'users') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-setting"></i>
                        </span>
                        <span class="title">Configuración</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                    
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>Ubicaciones</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url("plants") ?>">Plantas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("productionlines") ?>">Lineas/Celdas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("workstations") ?>">Estaciones De Trabajo</a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>Numeros De Parte</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url("parts/create") ?>">Crear Numero De Parte</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("parts") ?>">Ver Lista</a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>Equipos de Trabajo</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url("teams") ?>">Equipos de Trabajo</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("teams/create") ?>">Nuevo Equipo</a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>Alertas</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url("alerts") ?>">Alertas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("alerts/create") ?>">Nueva Alerta</a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>Pantallas</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url("screens") ?>">Pantallas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("screens/create") ?>">Nueva Pantalla</a>
                                </li>
                            </ul>
                        </li>




                        <li>
                            <a href="<?php echo base_url() ?>configuration">Opciones De La Aplicación</a>
                        </li>




                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if ($this->session->userdata('is_admin')): ?>
                <li <?php echo ($active == 'users') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-user-add"></i>
                        </span>
                        <span class="title">Usuarios</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url() ?>users/create">Registrar Usuario</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>users/create_operator">Registrar Operador</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>users/">Ver Lista</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            
            <li <?php echo ($active == 'reports') ? "style='background-color: rgba(3, 252, 102,.45); border-right: 2px solid; border-color: #02bf4d;'" : "" ?> class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-pie-chart"></i>
                    </span>
                    <span class="title">Reportes</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url() ?>reports">Generador De Reportes</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->
    <!-- Page Container START -->
    <div class="page-container">
            <!-- Content Wrapper START -->
            <div class="main-content">