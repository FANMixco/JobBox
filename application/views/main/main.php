<h1><?php echo $title; ?></h1><hr/><br/>
<div id="left">
    <!--Menu div-->
    <div id="options">                    
        <ul id="nav">
            <li>Tareas Frecuentes</li><hr />
            <li><a href=<?php echo base_url("user/profile") ?>>Perfil</a></li>
            <li><a href=<?php echo base_url("user/change_pass") ?>>Cambiar Contrase&ntilde;a</a></li>
            <li><a href=<?php echo base_url("job/apply") ?>>Aplicar Trabajos</a></li>
            <br />
            <?php 
                if ($this->session->userdata('level')==1)
                {
            ?>
                <li>Administrar</li><hr />
            <?php
            echo '
                    <li><a href='.base_url("academic_levels/").'>Niveles Educativos</a></li>
                    <li><a href='.base_url("academic_majors/").'>Carreras</a></li>
                    <li><a href='.base_url("countries/").'>Pa&iacute;ses</a></li>
                    <li><a href='.base_url("states/").'>Departamentos</a></li>
                    <li><a href='.base_url("cities/").'>Ciudades</a></li>
                    <li><a href='.base_url("honorifics/").'>Tratamientos</a></li>
                    <li><a href='.base_url("jobs/").'>Pa&iacute;ses</a></li>
                    <li><a href='.base_url("job_areas/").'>&Aacute;reas de Trabajo</a></li>
                    <li><a href='.base_url("languages/").'>Idiomas</a></li>
                    <li><a href='.base_url("language_levels/").'>Niveles de Idiomas</a></li>
                    <li><a href='.base_url("religions/").'>Pa&iacute;ses</a></li>
                    <li><a href='.base_url("schools/").'>Centros de Estudio</a></li>
                    <li><a href='.base_url("users/").'>Usuarios</a></li>
                    <li><a href='.base_url("user_level/").'>Niveles de Usuarios</a></li>
                        ';
                }
            ?>
        </ul>    
</div>
<div id="right"></div>