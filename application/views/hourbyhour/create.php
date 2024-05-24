<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("parts") ?>">Hora por Hora</a>
            <span class="breadcrumb-item active">Crear Orden De Trabajo</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhoir/create") ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4>Orden de trabajo</h4>
                <div class="m-t-25">

                    <!-- echo flash messages -->
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    

                   
                        <div class="row">

                            <div class="form-group col-lg-12 m-b-15">
                                <label for="workorder_number">Estación de trabajo</label>
                                <select class="select2" name="state" required>
                                    <option value="">Seleccionar Estación de trabajo</option>
                                    <?php foreach($workstations as $workstation) { ?>
                                        <option value="<?php echo $workstation['work_station_id']; ?>"><?php echo $workstation['work_station_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                           

                            <div class="form-group col-lg-12">
                                <label for="start_date">Fecha de inicio </label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo set_value('start_date'); ?>">
                                <?php echo form_error('start_date', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            <div class="form-group col-lg-12" >
                                <label for="part_description">Notas de la orden</label>
                                <textarea type="text" class="form-control" id="notes" name="notes" rows="5" placeholder="Descripción"><?php echo set_value('notes'); ?></textarea>
                                <?php echo form_error('part_description', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            
                        

                            <div class="form-group col-lg-6" >
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4>Hora por hora</h4>
                <div class="" >
                    <div class=" mt-5">

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Numero de parte</td>
                                    <td>Hora</td>
                                    <td>Cantidad</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_6" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>06:00 am - 07:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_6" placeholder="Cantidad">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_7" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_7" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_8" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>08:00 am - 09:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_8" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_9" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>09:00 am - 10:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_9" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_10" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>10:00 am - 11:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_10" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_11" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>11:00 am - 12:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_11" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_12" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>12:00 pm - 13:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_12" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_13" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>13:00 pm - 14:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_13" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_14" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>14:00 pm - 15:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_14" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_15" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>15:00 pm - 16:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_15" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_16" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>16:00 pm - 17:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_16" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_17" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>17:00 pm - 18:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_17" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_18" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>18:00 am - 19:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_18" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_19" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>19:00 pm - 20:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_19" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_20" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>20:00 am - 21:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_20" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number_21" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>21:00 pm - 22:00 pm</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity_21" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>
                                        <select class="select2"  name="part_number" >
                                            <option value="">Seleccionar Numero de Parte</option>
                                            <?php foreach($parts as $part) { ?>
                                                <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                            <?php } ?>  
                                        </select>
                                    </td>
                                    <td>07:00 am - 08:00 am</td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                                    </td>
                                </tr>

                                
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>